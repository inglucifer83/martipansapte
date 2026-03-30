import {
  App, Stack, CfnOutput, RemovalPolicy, Tags, Duration, SecretValue, CfnParameter,
  aws_ec2 as ec2,
  aws_iam as iam,
	aws_route53 as route53,
	aws_rds as rds,
	aws_s3 as s3,
	aws_cloudfront as cloudfront,
	aws_cloudfront_origins as origins,
  aws_codepipeline as codepipeline,
  aws_codepipeline_actions as cpactions,
  aws_codedeploy as codedeploy,
  aws_cloudtrail as cloudtrail,
} from 'aws-cdk-lib';
import { KeyPair } from 'aws-cdk-lib/aws-ec2';

class MartipansapteLocalStack extends Stack {
  constructor(scope, id, props = {}) {
    super(scope, id, props);

    // ---- Context / Parameters
    const ipAddress = this.node.tryGetContext('IpAddress') || null;
    const ssh = this.node.tryGetContext('Ssh') || null;
    const hostedZoneId = this.node.tryGetContext('hostedZoneId') || null;
		const domainName = 'martipansapte.com';
    const ami = ec2.MachineImage.genericLinux({'eu-south-1': 'ami-03ddf59cb93f2d2b0'});
		const dbPort = 3306;
    
    // ---- VPC
    const vpc = new ec2.Vpc(this, 'Vpc', {
      maxAzs: 2,
      natGateways: 0,
      subnetConfiguration: [
        { name: 'public', subnetType: ec2.SubnetType.PUBLIC },
      ],
    });

    // ---- Security Groups
    const webSg = new ec2.SecurityGroup(this, 'WebSg', {
      vpc,
      allowAllOutbound: true,
      description: 'Public web SG for EC2',
    });

    webSg.addIngressRule(ec2.Peer.anyIpv4(), ec2.Port.tcp(80), 'HTTP');
    webSg.addIngressRule(ec2.Peer.anyIpv4(), ec2.Port.tcp(443), 'HTTPS');
    if (ipAddress && ssh) {
      webSg.addIngressRule(ec2.Peer.ipv4(`${ipAddress}/32`), ec2.Port.tcp(22), 'SSH');
    }

    // ---- IAM
    const ec2Role = new iam.Role(this, 'Ec2Role', {
      assumedBy: new iam.ServicePrincipal('ec2.amazonaws.com'),
      description: 'EC2 role for martipansapte app',
    });

    ec2Role.addManagedPolicy(iam.ManagedPolicy.fromAwsManagedPolicyName('AmazonSSMManagedInstanceCore'));
    
    // ---- EC2
    const keyPair = new KeyPair(this, 'martipansapte', {
      keyPairName: 'martipansapte',
      type: ec2.KeyPairType.RSA
    });

    const instance = new ec2.Instance(this, 'MartipansapteEc2', {
      vpc,
      vpcSubnets: { subnetType: ec2.SubnetType.PUBLIC },
      instanceType: new ec2.InstanceType('t3.micro'),
      machineImage: ami,
      securityGroup: webSg,
      keyPair,
      role: ec2Role,
      blockDevices: [
        {
          deviceName: '/dev/xvda',
          volume: ec2.BlockDeviceVolume.ebs(8, {
            volumeType: ec2.EbsDeviceVolumeType.GP3,
            encrypted: true,
            deleteOnTermination: true,
          }),
        },
      ],
    });

    const userData = [
		    "#!\/bin\/bash",
		    "dnf upgrade -y",
		    "",
		    "dnf install -y httpd wget php-fpm php-mysqlnd php-json php-mbstring php php-devel ruby certbot python3-certbot-apache nodejs bind-utils  python3-pip",
		    "pip install supervisor",
		    "systemctl enable httpd",
		    "systemctl start httpd",
		    "usermod -a -G apache ec2-user",
		    "mkdir \/var\/www\/html\/martipansapte",
		    "chown -R ec2-user:apache \/var\/www",
		    "chmod 2775 \/var\/www && find \/var\/www -type d -exec chmod 2775 {} \\;",
		    "find \/var\/www -type f -exec chmod 0664 {} \\;",
		    "cat >\/etc\/httpd\/conf.d\/martipansapte.conf <<'CONF'\n<VirtualHost *:80>\n\tServerName martipansapte.com\n\tDocumentRoot \/var\/www\/html\/martipansapte\/public\n\t<Directory \/var\/www\/html\/martipansapte\/public>\n\t\tAllowOverride All\n\t\tRequire all granted\n\t\tOptions FollowSymLinks\n\t<\/Directory>\n<\/VirtualHost>\nCONF",
		    "systemctl restart httpd",
		    "cd \/home\/ec2-user",
		    "wget https:\/\/aws-codedeploy-eu-south-1.s3.eu-south-1.amazonaws.com\/latest\/install",
		    "chmod +x .\/install",
		    ".\/install auto",
		    "systemctl enable codedeploy-agent",
		    "systemctl start codedeploy-agent",
		    "echo_supervisord_conf > \/etc\/supervisord.conf",
		    "cat >\/usr\/lib\/systemd\/system\/supervisord.service <<'EOF'\n[Unit]\nDescription=Process Monitoring and Control Daemon\nAfter=rc-local.service nss-user-lookup.target\n\n[Service]\nType=forking\nExecStart=\/usr\/local\/bin\/supervisord -c \/etc\/supervisord.conf\n\n[Install]\nWantedBy=multi-user.target\nEOF",
		    "mkdir -p \/var\/log\/supervisor",
		    "mkdir -p \/var\/run\/supervisor\/",
		    "touch \/var\/run\/supervisor\/supervisor.sock",
		    "cat >\/usr\/local\/bin\/certbot-dns-wait.sh <<'EOF'\n#!bash\nset -euo pipefail\n\n# If cert already exists, exit successfully (idempotent)\nif [ -d \"\/etc\/letsencrypt\/live\/${martipansapte.com}\" ]; then\n  echo \"Certificate for ${martipansapte.com} already present! Exiting.\"\n  exit 0\nfi\n\n# Load config\nRESOLVER=\"${RESOLVER:-1.1.1.1}\"\n\n# Determine our instance public IP (EIP or instance public IP)\nSELF_IP=\"$(curl -fsS --retry 3 --max-time 2 http:\/\/169.254.169.254\/latest\/meta-data\/public-ipv4 || true)\"\n\n# Figure out Apache service name (httpd on RHEL\/AL, apache2 on Debian\/Ubuntu\/SUSE)\nAPACHE_SVC=\"httpd\"\nif systemctl list-unit-files | grep -q '^apache2\\.service'; then\n  APACHE_SVC=\"apache2\"\nfi\n\n# Wait up to ~10 minutes for DNS A record to match our IP\nattempts=60\nsleep_secs=30\necho \"Waiting for DNS ${martipansapte.com} to resolve to ${SELF_IP} ...\"\nfor i in $(seq 1 $attempts); do\n  DNS_IP=\"$(dig +short A \"${martipansapte.com}\" @\"${RESOLVER}\" | head -n1 || true)\"\n  if [ -n \"${DNS_IP}\" ] && [ -n \"${SELF_IP}\" ] && [ \"${DNS_IP}\" = \"${SELF_IP}\" ]; then\n    echo \"DNS OK: ${martipansapte.com} -> ${DNS_IP}\"\n    break\n  fi\n  echo \"[$i\/${attempts}] DNS now: ${DNS_IP:-<none>}, expected: ${SELF_IP:-<unknown>}. Retrying in ${sleep_secs}s...\"\n  sleep \"${sleep_secs}\"\ndone\n\n# Final check\nDNS_IP=\"$(dig +short A \"${martipansapte.com}\" @\"${RESOLVER}\" | head -n1 || true)\"\nif [ -z \"${DNS_IP}\" ] || [ -z \"${SELF_IP}\" ] || [ \"${DNS_IP}\" != \"${SELF_IP}\" ]; then\n  echo \"DNS still not pointing here; will retry later via systemd timer.\"\n  exit 75  # temp failure so timer retries\nfi\n\n# Ensure Apache is running (needed for --apache installer)\nsystemctl enable --now \"${APACHE_SVC}\"\n\n# Obtain\/renew cert (idempotent with --keep-until-expiring)\ncertbot --apache \\\n  -d \"${martipansapte.com}\" \\\n  --non-interactive --agree-tos -m \"${info@stx-software.com}\" \\\n  --redirect --keep-until-expiring --rsa-key-size 4096\n\n# Reload Apache to pick up cert\/redirect if needed\nsystemctl reload \"${APACHE_SVC}\" || true\n\n# disable timer after first success\nsystemctl disable --now ___%PROJECT_SLUG%___-certbot.timer || true\n\n(crontab -l 2>\/dev\/null | grep -v 'certbot renew -q --non-interactive'; echo \"0 0,12 * * * certbot renew -q --non-interactive --post-hook \\\"systemctl reload ${APACHE_SVC}\\\"\") | crontab -\n\necho \"Certbot completed!\"\nEOF",
		    "chmod +x \/usr\/local\/bin\/certbot-dns-wait.sh",
		    "cat >\/etc\/systemd\/system\/martipansapte-certbot.service <<'EOF'\n[Unit]\nDescription=Wait for DNS and provision Let's Encrypt cert (Apache)\nWants=network-online.target\nAfter=network-online.target\n\n[Service]\nType=oneshot\nExecStart=\/usr\/local\/bin\/certbot-dns-wait.sh\nTimeoutStartSec=900\n# If it fails (e.g., DNS not ready), allow timer to retry\nRemainAfterExit=no\n\n[Install]\nWantedBy=multi-user.target\nEOF",
		    "cat >\/etc\/systemd\/system\/martipansapte-certbot.timer <<'EOF'\n[Unit]\nDescription=Run {{ martipansapte}}-certbot shortly after boot and retry periodically\n\n[Timer]\n# first run ~2 minutes after boot\nOnBootSec=2min\n# then retry every 10 minutes if it failed (service exits non-zero)\nOnUnitActiveSec=10min\nAccuracySec=1min\nUnit={{ martipansapte}}-certbot.service\nPersistent=true\n\n[Install]\nWantedBy=timers.target\nEOF\n\n",
		    "systemctl daemon-reload",
		    "systemctl enable --now martipansapte-certbot.timer",
		    "systemctl enable --now supervisord"
		];

    instance.addUserData(...userData);

    // ---- Elastic IP
    const eip = new ec2.CfnEIP(this, 'Ec2Eip', { domain: 'vpc' });

    new ec2.CfnEIPAssociation(this, 'Ec2EipAssoc', {
      allocationId: eip.attrAllocationId,
      instanceId: instance.instanceId,
    });

    instance.node.addDependency(eip);
    

    // ---- Route53
    const zone = hostedZoneId ? route53.HostedZone.fromHostedZoneAttributes(this, 'HostedZone', {
        hostedZoneId,
        zoneName: domainName,
      }) : null;
    if (zone) {
      const aRecord = new route53.ARecord(this, 'martipansapteARecord', {
        zone,
        target: route53.RecordTarget.fromIpAddresses(eip.attrPublicIp),
        ttl: Duration.seconds(300),
      });

      instance.node.addDependency(aRecord);
    }
    
    // ---- S3
		const mediaBucket = new s3.Bucket(this, 'mediaBucket', {
			bucketName: 'martipansapte-media',
			removalPolicy: RemovalPolicy.DESTROY,
			autoDeleteObjects: true,
			enforceSSL: true,
		});

		mediaBucket.grantReadWrite(ec2Role);

    // ---- Cloudfront
    const distribution = new cloudfront.Distribution(this, 'PublicCdn', {
      defaultBehavior: {
        origin: new origins.S3BucketOrigin(publicBucket, {
          originPath: '/',
        }),
        viewerProtocolPolicy: cloudfront.ViewerProtocolPolicy.REDIRECT_TO_HTTPS,
        cachePolicy: cloudfront.CachePolicy.CACHING_OPTIMIZED,
      },
      defaultRootObject: 'index.html',
    });

    new CfnOutput(this, 'AssetUrl', { value: `https://${distribution.distributionDomainName}` });

    
    // ---- RDS
    const reachDb = this.node.tryGetContext('ReachDb') || null;

    const dbSg = new ec2.SecurityGroup(this, 'DbSg', {
      vpc,
      allowAllOutbound: true,
      description: 'RDS Security Group',
    });
    
    if (ipAddress && reachDb) {
      dbSg.addIngressRule(ec2.Peer.ipv4(`${ipAddress}/32`), ec2.Port.tcp(dbPort), 'Allow instance connections from my public IP address');
    }

    const engine = rds.DatabaseInstanceEngine.mysql({
			version: rds.MysqlEngineVersion.VER_8_0
		});

    const dbPassword = new CfnParameter(this, 'DbPwd', {
      type: 'String',
      noEcho: true,           
      minLength: 8,
      description: 'Master DB password (min 8 chars)',
    });

    const credentials = rds.Credentials.fromPassword(
      'martipansapte',
      SecretValue.cfnParameter(dbPassword)
    );

    const dbInstance = new rds.DatabaseInstance(this, 'MySQL', {
      vpc,
      vpcSubnets: { subnetType: ec2.SubnetType.PUBLIC },
      engine,
      credentials,
      instanceType: new ec2.InstanceType('t3.micro'),
      multiAz: false,
      allocatedStorage: 20,
      storageType: rds.StorageType.GP3,
      databaseName: 'martipansapte',
      securityGroups: [dbSg],
      deletionProtection: false,
      backupRetention: Duration.days(3),
      removalPolicy: RemovalPolicy.SNAPSHOT,
      publiclyAccessible: true
    });

    dbInstance.connections.allowFrom(webSg, ec2.Port.tcp(dbPort), 'Allow EC2 instance connections');

    new CfnOutput(this, 'DbHost', { value: dbInstance.instanceEndpoint.hostname });
    new CfnOutput(this, 'DbPassword', { value: dbPassword });
    
    
    // ---- SQS
		const defaultQueue = new sqs.Queue(this, 'martipansapte-defaultQueue', {
			queueName: 'default',
			fifo: false,
			visibilityTimeout: Duration.seconds(300),
			retentionPeriod: Duration.days(1),
			removalPolicy: RemovalPolicy.DESTROY
		});

		defaultQueue.grantSendMessages(instance.role);
		defaultQueue.grantConsumeMessages(instance.role);
		defaultQueue.grantPurge(instance.role);

		const emailsQueue = new sqs.Queue(this, 'martipansapte-emailsQueue', {
			queueName: 'emails',
			fifo: false,
			visibilityTimeout: Duration.seconds(300),
			retentionPeriod: Duration.days(1),
			removalPolicy: RemovalPolicy.DESTROY
		});

		emailsQueue.grantSendMessages(instance.role);
		emailsQueue.grantConsumeMessages(instance.role);
		emailsQueue.grantPurge(instance.role);

    // ---- DYNAMODB
		const sessionsTable = new dynamodb.Table(this, 'sessionsTable', {
			tableName: 'martipansapte-sessions',
			partitionKey: { name: 'key', type: dynamodb.AttributeType.STRING },
			billingMode: dynamodb.BillingMode.PAY_PER_REQUEST,
			pointInTimeRecoverySpecification: {
				pointInTimeRecoveryEnabled: true
			},
			timeToLiveAttribute: 'ttl',
			removalPolicy: RemovalPolicy.DESTROY,
		});

		sessionsTable.grantReadWriteData(instance.role);
		
		const cacheTable = new dynamodb.Table(this, 'cacheTable', {
			tableName: 'martipansapte-cache',
			partitionKey: { name: 'key', type: dynamodb.AttributeType.STRING },
			billingMode: dynamodb.BillingMode.PAY_PER_REQUEST,
			pointInTimeRecoverySpecification: {
				pointInTimeRecoveryEnabled: true
			},
			timeToLiveAttribute: 'ttl',
			removalPolicy: RemovalPolicy.DESTROY,
		});

		cacheTable.grantReadWriteData(instance.role);
		
    // ---- APP Deployment

		const sourceBucketName = 'martipansapte-source-artifacts';
    const artifactBucketName = 'martipansapte-artifacts-store';
    const trailBucketName = 'martipansapte-trail-store';
    const sourceObjectKey  = 'martipansapte.zip'; 

    // ---------- Source Bucket
    const sourceBucket = new s3.Bucket(this, 'PipelineSourceBucket', {
      bucketName: sourceBucketName,       
      versioned: true, 
      blockPublicAccess: s3.BlockPublicAccess.BLOCK_ALL,
			removalPolicy: RemovalPolicy.DESTROY,
      autoDeleteObjects: true,
      enforceSSL: true,
    });

    // ---------- Artifact Bucket
    const artifactBucket = new s3.Bucket(this, 'PipelineArtifactBucket', {
      bucketName: artifactBucketName,       
      versioned: true,                        
      encryption: s3.BucketEncryption.S3_MANAGED,
      blockPublicAccess: s3.BlockPublicAccess.BLOCK_ALL,
      enforceSSL: true,
      removalPolicy: RemovalPolicy.DESTROY,
      autoDeleteObjects: true,
    });

    artifactBucket.grantRead(instance);

    // ---------- Trail Bucket
    const trailBucket = new s3.Bucket(this, 'TrailBucket', {
      bucketName: trailBucketName,       
      versioned: true,                        
      blockPublicAccess: s3.BlockPublicAccess.BLOCK_ALL,
      enforceSSL: true,
      removalPolicy: RemovalPolicy.DESTROY,
      autoDeleteObjects: true,
    });

    // ---------- Cloudtrail
    const trail = new cloudtrail.Trail(this, 'PipelineTrail', {
      bucket: trailBucket,
      isMultiRegionTrail: false,
      managementEvents: cloudtrail.ReadWriteType.NONE,
    });

    trail.addS3EventSelector(
      [
        {
          bucket: sourceBucket
        },
      ],
      {
        includeManagementEvents: false,
        readWriteType: cloudtrail.ReadWriteType.WRITE_ONLY, // react to PUTs
      }
    );

    // ---------- Codedeploy 
    Tags.of(instance).add('CodeDeploy', 'true'); // tag instance so DeploymentGroup can target it

    const cdApp = new codedeploy.ServerApplication(this, 'CdApp', {
      applicationName: 'martipansapte',
    });

    const cdGroup = new codedeploy.ServerDeploymentGroup(this, 'CdGroup', {
      application: cdApp,
      deploymentGroupName: 'martipansapte',
      ec2InstanceTags: new codedeploy.InstanceTagSet({ CodeDeploy: ['true'] }),
      installAgent: false, 
      autoRollback: { failedDeployment: true, stoppedDeployment: true },
    });

    // ---------- Codepipeline
    const sourceOutput = new codepipeline.Artifact('SourceOutput');

    const pipeline = new codepipeline.Pipeline(this, 'martipansaptePipeline', {
      pipelineName: 'martipansapte',
      artifactBucket
    });

    pipeline.addStage({
      stageName: 'Source',
      actions: [
        new cpactions.S3SourceAction({
          actionName: 'S3Source',
          bucket: sourceBucket,
          bucketKey: sourceObjectKey,       
          output: sourceOutput,
          trigger: cpactions.S3Trigger.EVENTS,
        }),
      ],
    });

    pipeline.addStage({
      stageName: 'Deploy',
      actions: [
        new cpactions.CodeDeployServerDeployAction({
          actionName: 'CodeDeployInplace',
          input: sourceOutput,
          deploymentGroup: cdGroup
        }),
      ],
    });
    // ---- SES
// ---- SES
        if (zone) {
            const mailFromSubdomain = 'mail';
            const mailFromDomain = `${mailFromSubdomain}.${domainName}`;
            const inboundRecipient = `___%INBOX%___@${domainName}`;

            const identity = new ses.EmailIdentity(this, 'DomainIdentity', {
                identity: ses.Identity.domain(domainName),
                mailFromDomain
            });

            const configSet = new ses.ConfigurationSet(this, 'ConfigSet', {
                configurationSetName: 'AppConfigSet'
            });

            const inboundSesMxHost = `inbound-smtp.${this.region}.amazonaws.com`;
            new route53.MxRecord(this, 'InboundMxForRoot', {
                zone,
                values: [{ priority: 10, hostName: inboundSesMxHost }],
                ttl: Duration.minutes(5)
            });


            new route53.TxtRecord(this, 'RootSpf', {
                zone,
                values: ['v=spf1 include:amazonses.com -all'],
                ttl: Duration.minutes(5)
            });

            const feedbackMxHost = `feedback-smtp.${this.region}.amazonses.com`;
                new route53.MxRecord(this, 'MailFromMx', {
                zone,
                recordName: mailFromDomain, // e.g., mail.example.com
                values: [{ priority: 10, hostName: feedbackMxHost }],
                ttl: Duration.minutes(5)
            });

            new route53.TxtRecord(this, 'MailFromSpf', {
                zone,
                recordName: mailFromDomain, // e.g., mail.example.com
                values: ['v=spf1 include:amazonses.com -all'],
                ttl: Duration.minutes(5)
            });

            const inboundBucket = new s3.Bucket(this, 'InboundMailBucket', {
                enforceSSL: true,
                blockPublicAccess: s3.BlockPublicAccess.BLOCK_ALL,
                encryption: s3.BucketEncryption.S3_MANAGED,
                autoDeleteObjects: true,
                removalPolicy: RemovalPolicy.DESTROY
            });

            inboundBucket.addToResourcePolicy(new iam.PolicyStatement({
                sid: 'AllowSESPuts',
                effect: iam.Effect.ALLOW,
                principals: [new iam.ServicePrincipal('ses.amazonaws.com')],
                actions: ['s3:PutObject'],
                resources: [inboundBucket.arnForObjects('inbound/*')],
                conditions: { StringEquals: { 'aws:Referer': Aws.ACCOUNT_ID } }
            }));

            const processorFn = new lambda.Function(this, 'InboundProcessorFn', {
                runtime: lambda.Runtime.NODEJS_20_X,
                handler: 'index.handler',
                timeout: Duration.seconds(60),
                environment: {
                    BUCKET_NAME: inboundBucket.bucketName,
                    PREFIX: 'inbound/',
                },
                code: lambda.Code.fromAsset('lambda/email')
            });

            inboundBucket.grantRead(processorFn, 'inbound/*');

            const ruleSet = new ses.ReceiptRuleSet(this, 'ReceiptRuleSet', {
                receiptRuleSetName: 'PrimaryRuleSet'
            });

            ruleSet.addRule('InboundRule', {
                recipients: [inboundRecipient],
                enabled: true,
                scanEnabled: true,
                actions: [
                    new sesActions.S3({
                        bucket: inboundBucket,
                        objectKeyPrefix: 'inbound/'
                    }),
                    new sesActions.Lambda({
                        function: processorFn,
                        invocationType: sesActions.LambdaInvocationType.EVENT
                    }),
                ]
            });
        }
        

        // new cdk.CfnOutput(this, 'VerifiedDomain', { value: identity.identityName });
        // new cdk.CfnOutput(this, 'MailFromDomain', { value: mailFromDomain });
        // new cdk.CfnOutput(this, 'RootInboundMxHost', { value: inboundSesMxHost });
        // new cdk.CfnOutput(this, 'MailFromFeedbackMxHost', { value: feedbackMxHost });
        // new cdk.CfnOutput(this, 'InboundBucket', { value: inboundBucket.bucketName });
        // new cdk.CfnOutput(this, 'ReceiptRuleSetName', { value: ruleSet.receiptRuleSetName || 'PrimaryRuleSet' });
        // new cdk.CfnOutput(this, 'InboundRecipient', { value: inboundRecipient });
        // new cdk.CfnOutput(this, 'ConfigurationSet', { value: configSet.configurationSetName });

// ---- SES
        if (zone) {
            const mailFromSubdomain = 'mail';
            const mailFromDomain = `${mailFromSubdomain}.${domainName}`;
            const inboundRecipient = `___%INBOX%___@${domainName}`;

            const identity = new ses.EmailIdentity(this, 'DomainIdentity', {
                identity: ses.Identity.domain(domainName),
                mailFromDomain
            });

            const configSet = new ses.ConfigurationSet(this, 'ConfigSet', {
                configurationSetName: 'AppConfigSet'
            });

            const inboundSesMxHost = `inbound-smtp.${this.region}.amazonaws.com`;
            new route53.MxRecord(this, 'InboundMxForRoot', {
                zone,
                values: [{ priority: 10, hostName: inboundSesMxHost }],
                ttl: Duration.minutes(5)
            });


            new route53.TxtRecord(this, 'RootSpf', {
                zone,
                values: ['v=spf1 include:amazonses.com -all'],
                ttl: Duration.minutes(5)
            });

            const feedbackMxHost = `feedback-smtp.${this.region}.amazonses.com`;
                new route53.MxRecord(this, 'MailFromMx', {
                zone,
                recordName: mailFromDomain, // e.g., mail.example.com
                values: [{ priority: 10, hostName: feedbackMxHost }],
                ttl: Duration.minutes(5)
            });

            new route53.TxtRecord(this, 'MailFromSpf', {
                zone,
                recordName: mailFromDomain, // e.g., mail.example.com
                values: ['v=spf1 include:amazonses.com -all'],
                ttl: Duration.minutes(5)
            });

            const inboundBucket = new s3.Bucket(this, 'InboundMailBucket', {
                enforceSSL: true,
                blockPublicAccess: s3.BlockPublicAccess.BLOCK_ALL,
                encryption: s3.BucketEncryption.S3_MANAGED,
                autoDeleteObjects: true,
                removalPolicy: RemovalPolicy.DESTROY
            });

            inboundBucket.addToResourcePolicy(new iam.PolicyStatement({
                sid: 'AllowSESPuts',
                effect: iam.Effect.ALLOW,
                principals: [new iam.ServicePrincipal('ses.amazonaws.com')],
                actions: ['s3:PutObject'],
                resources: [inboundBucket.arnForObjects('inbound/*')],
                conditions: { StringEquals: { 'aws:Referer': Aws.ACCOUNT_ID } }
            }));

            const processorFn = new lambda.Function(this, 'InboundProcessorFn', {
                runtime: lambda.Runtime.NODEJS_20_X,
                handler: 'index.handler',
                timeout: Duration.seconds(60),
                environment: {
                    BUCKET_NAME: inboundBucket.bucketName,
                    PREFIX: 'inbound/',
                },
                code: lambda.Code.fromAsset('lambda/email')
            });

            inboundBucket.grantRead(processorFn, 'inbound/*');

            const ruleSet = new ses.ReceiptRuleSet(this, 'ReceiptRuleSet', {
                receiptRuleSetName: 'PrimaryRuleSet'
            });

            ruleSet.addRule('InboundRule', {
                recipients: [inboundRecipient],
                enabled: true,
                scanEnabled: true,
                actions: [
                    new sesActions.S3({
                        bucket: inboundBucket,
                        objectKeyPrefix: 'inbound/'
                    }),
                    new sesActions.Lambda({
                        function: processorFn,
                        invocationType: sesActions.LambdaInvocationType.EVENT
                    }),
                ]
            });
        }
        

        // new cdk.CfnOutput(this, 'VerifiedDomain', { value: identity.identityName });
        // new cdk.CfnOutput(this, 'MailFromDomain', { value: mailFromDomain });
        // new cdk.CfnOutput(this, 'RootInboundMxHost', { value: inboundSesMxHost });
        // new cdk.CfnOutput(this, 'MailFromFeedbackMxHost', { value: feedbackMxHost });
        // new cdk.CfnOutput(this, 'InboundBucket', { value: inboundBucket.bucketName });
        // new cdk.CfnOutput(this, 'ReceiptRuleSetName', { value: ruleSet.receiptRuleSetName || 'PrimaryRuleSet' });
        // new cdk.CfnOutput(this, 'InboundRecipient', { value: inboundRecipient });
        // new cdk.CfnOutput(this, 'ConfigurationSet', { value: configSet.configurationSetName });


    new CfnOutput(this, 'AwsDefaultRegion', { value: props.env.region });
    new CfnOutput(this, 'KeyId', { value: keyPair.keyPairId });
  }
}

const app = new App();
new MartipansapteLocalStack(app, 'MartipansapteLocalStack', {
  env: {
    region: 'eu-south-1'
  }
});