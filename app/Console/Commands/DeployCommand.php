<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;
class DeployCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:deploy {env?} {hosteZoneId?} {--profile=}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deploys the whole infrastructure and the application';
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $env = $this->argument('env');
        if (!$env) {
            $infrastructureFiles = scandir(base_path('infrastructure/bin'));
            $choices = [];
            foreach ($infrastructureFiles as $fileName) {
                if (!Str::endsWith($fileName, '.js')) {
                    continue;
                }
                $choices[] = str_replace('.js', '', basename($fileName));
            }
            if (count($choices) > 1) {
                $env = $this->choice('Which environment do you want to deploy?', $choices, $choices[0]);
            } else {
                $env = $choices[0];
            }
        }
        $hostedZone = $this->argument('hosteZoneId') ? trim($this->argument('hosteZoneId')) : null;
        $profile = $this->option('profile');
        $awsCheck = Process::run('aws --version');
        $hasAWSCli = !Str::contains($awsCheck->output(), 'command not found');
        if (!$hasAWSCli) {
            if ($this->confirm('The AWS Command Line Interface tool is not installed, proceed with installation?', true)) {
                $os = strtolower(PHP_OS);
                $localDisk = Storage::build(['driver' => 'local', 'root' => base_path()]);
                if ($os == 'darwin') {
                    Process::tty()->timeout(300)->run('curl "https://awscli.amazonaws.com/AWSCLIV2.pkg" -o "AWSCLIV2.pkg" && sudo installer -pkg AWSCLIV2.pkg -target /');
                    if ($localDisk->exists('AWSCLIV2.pkg')) {
                        $localDisk->delete('AWSCLIV2.pkg');
                    }
                } else if (Str::startsWith($os, 'win')) {
                    Process::tty()->timeout(300)->run('msiexec.exe /i https://awscli.amazonaws.com/AWSCLIV2.msi');
                } else {
                    Process::tty()->timeout(300)->run('curl "https://awscli.amazonaws.com/awscli-exe-linux-aarch64.zip" -o "awscliv2.zip" && unzip awscliv2.zip && sudo ./aws/install');
                    if ($localDisk->exists('AWSCLIV2.pkg')) {
                        $localDisk->delete('awscliv2.zip');
                    }
                    if ($localDisk->exists('aws')) {
                        $localDisk->deleteDirectory('aws');
                    }
                }
                Process::tty()->timeout(300)->run('aws configure');
            } else {
                $this->error('The AWS Command Line Interface tool is required if you don\'t specify a hosted zone and a profile! Aborting...');
                return;
            }
        }
        if ($hasAWSCli) {
            $profilesOutput = Process::run('aws configure list-profiles --output json');
            $profiles = collect(explode("\n", $profilesOutput->output()))->map(function ($profile) {
                return trim($profile);
            })->filter(function ($profile) {
                return $profile;
            })->toArray();
            if (count($profiles) > 0) {
                if (!$profile) {
                    if (count($profiles) == 1) {
                        $profile = $profiles[0];
                    } else {
                        $profile = $this->choice('Which profile do you want to use?', $profiles, $profiles[0]);
                    }
                } else if (!in_array($profile, $profiles)) {
                    $this->error('The given profile cannot be found!');
                    $profile = $this->choice('Please select one of the profiles below?', $profiles, $profiles[0]);
                }
            } else {
                $this->error('No AWS profiles found! A profile is required to proceed with deployment! Aborting...');
                return;
            }
            $this->info("Using {$profile} profile!");
            $zonesOutput = Process::run("aws route53 list-hosted-zones --profile {$profile} --output json");
            $zonesArray = json_decode($zonesOutput->output(), true);
            $eligibleZone = collect($zonesArray['HostedZones'])->filter(function ($zone) {
                return $zone['Name'] == 'martipansapte.com.';
            })->first();
            $eligibleId = $eligibleZone ? trim(str_replace('/hostedzone/', '', $eligibleZone['Id'])) : null;
            if (!$eligibleId) {
                $this->warn("No hosted zone with name 'martipansapte.com' found! Route53 will not be setup during deployment!");
            }
            if (!$hostedZone && $eligibleId) {
                $hostedZone = $eligibleId;
            } else if ($hostedZone && $eligibleZone && $eligibleId != $hostedZone) {
                $hostedZone = null;
                $this->warn("The provided hosted zone id does not match the hosted zone with name 'martipansapte.com'! Route53 will not be setup during deployment!");
            }
            if ($hostedZone) {
                $this->info("Using hosted zone with id {$hostedZone}!");
            }
        }
        $profileOption = $profile ? " --profile {$profile}" : '';
        if (!file_exists('infrastructure/node_modules')) {
            Process::tty()->timeout(300)->run('cd infrastructure && npm i', function ($type, $output) {
                $this->line($output);
            });
        }
        $bootstrapParamsForward = $profileOption ? '--' : '';
        Process::tty()->timeout(300)->run("cd infrastructure && npm run bootstrap:{$env} {$bootstrapParamsForward}{$profileOption}", function ($type, $output) {
            $this->line($output);
        });
        $hostedZoneOption = $hostedZone ? " -c hostedZoneId={$hostedZone}" : '';
        $ip = file_get_contents('https://api.ipify.org');
        $sshOption = '';
        if ($this->confirm("Add an inbound rule to connect via SSH to your instance from your current public IP address ({$ip})?", true)) {
            $sshOption = " -c IpAddress={$ip} -c Ssh=yes";
        }
        $dbReachOption = '';
        if ($this->confirm("Add an inbound rule to connect to your Database from your current public IP address ({$ip})?", true)) {
            if (!$sshOption) {
                $dbReachOption .= " -c IpAddress={$ip}";
            }
            $dbReachOption = " -c ReachDb=yes";
        }
        $dbPassword = Str::random();
        if (file_exists(base_path("infrastructure/{$env}_outputs.json"))) {
            $previousOutput = json_decode(file_get_contents(base_path("infrastructure/{$env}_outputs.json")), true);
            $previousOuputKey = 'Martipansapte' . ucfirst($env) . 'Stack';
            $previousStack = $previousOutput[$previousOuputKey];
            $previousPassword = isset($previousStack['DbPassword']) ? $previousStack['DbPassword'] : null;
            if ($previousPassword) {
                if (!$this->confirm('A previous deployment already assigned a database password, do you want to change it?')) {
                    $dbPassword = $previousPassword;
                }
            }
        }
        $dbPasswordOption = " --parameters DbPwd={$dbPassword}";
        $deployProces = Process::tty()->forever()->run("cd infrastructure && npm run deploy:{$env} --{$hostedZoneOption}{$sshOption}{$dbReachOption}{$dbPasswordOption}{$profileOption} --outputs-file {$env}_outputs.json", function ($type, $output) {
            $this->line($output);
        });
        if ($deployProces->successful() && file_exists(base_path("infrastructure/{$env}_outputs.json"))) {
            $output = json_decode(file_get_contents(base_path("infrastructure/{$env}_outputs.json")), true);
            $envFile = file_get_contents(base_path("{$env}.env"));
            $outputKey = 'Martipansapte' . ucfirst($env) . 'Stack';
            $stack = $output[$outputKey];
            $region = $stack['AwsDefaultRegion'];
            $keyId = $stack['KeyId'];
            if (!file_exists(base_path('Martipansapte.pem'))) {
                $this->line('Retrieving private key for SSH access...');
                Process::run("aws ssm get-parameter --name \"/ec2/keypair/{$keyId}\" --with-decryption --query Parameter.Value --region {$region}{$profileOption} --output text > Martipansapte.pem && chmod 600 Martipansapte.pem");
                $this->info('Private key saved as "Martipansapte.pem"!');
            }
            $stack['DB_USERNAME'] = 'martipansapte';
            $awsKeyRun = Process::run("aws configure get aws_access_key_id --profile {$profile}");
            $stack['AWS_ACCESS_KEY_ID'] = $awsKeyRun->output();
            $awsSecretRun = Process::run("aws configure get aws_secret_access_key --profile {$profile}");
            $stack['AWS_SECRET_ACCESS_KEY'] = $awsSecretRun->output();
            foreach ($stack as $key => $value) {
                $normalizedKey = Str::contains($key, '_') ? $key : strtoupper(Str::snake($key));
                $re = "/{$normalizedKey}=.*/m";
                $envFile = preg_replace($re, "{$normalizedKey}={$value}", $envFile);
            }
            file_put_contents(base_path('.env'), $envFile);
            if (file_exists(base_path('.env'))) {
                file_put_contents(base_path('.env.backup'), file_get_contents(base_path('.env')));
            }
            if ($hasAWSCli) {
                $this->line('Deploying application...');
                file_put_contents(base_path('appspec.yml'), str_replace('%ENV%', "{$env}", file_get_contents(base_path('base_appspec.yml'))));
                file_put_contents(base_path("supervisord.conf"), file_get_contents(base_path("supervisord_{$env}.conf")));
                $this->line('Zipping application folder...');
                Process::tty()->timeout(300)->run('zip -r martipansapte.zip . -x ./supervisord_test.conf ./supervisord_local.conf ./test.env ./local.env ./.env.backup ./Martipansapte.pem ./vendor/\* ./storage/logs/\* .storage/framework/\* ./infrastructure/\* ./node_modules/\* ./app/Console/Commands/DeployCommand.php ./base_appspec.yml');
                $this->line('Uploading to S3 source bucket...');
                Process::tty()->timeout(300)->run("aws s3 cp martipansapte.zip s3://martipansapte-source-artifacts/martipansapte.zip --region {$region}{$profileOption}");
                $this->info('Application uploaded! The Codepipeline deployment should start now!');
                $this->line('Cleaing up...');
                unlink(base_path(".env"));
                if (file_exists(base_path('.env.backup'))) {
                    file_put_contents(base_path(".env"), file_get_contents(base_path(".env.backup")));
                }
                unlink(base_path("supervisord.conf"));
                unlink(base_path('appspec.yml'));
                unlink(base_path('martipansapte.zip'));
                $this->newLine();
                $this->info("Done!");
            } else {
                $this->line('The AWS command line interface tool is required to deploy the application.');
            }
        } else {
            $this->error('Deployment failed!');
        }
    }
}