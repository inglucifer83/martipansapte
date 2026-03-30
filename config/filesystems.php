<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been set up for each driver as an example of the required values.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [
        'local' => [
			'driver' => 'local',
			'root' => storage_path('app'),
			'throw' => '',
		],
		'public' => [
			'driver' => 'local',
			'root' => storage_path('app/public'),
			'url' => env('APP_URL') .'/storage',
			'visibility' => 'public',
			'throw' => '',
		],
		'ftp' => [
			'driver' => 'ftp',
			'host' => env('FILESYSTEM_FTP_HOST'),
			'username' => env('FILESYSTEM_FTP_USERNAME'),
			'password' => env('FILESYSTEM_FTP_PASSWORD'),
			'port' => env('FILESYSTEM_FTP_PORT', 21),
			'root' => env('FILESYSTEM_FTP_ROOT'),
			'passive' => '1',
			'ssl' => '1',
			'timeout' => '30',
		],
		'sftp' => [
			'driver' => 'sftp',
			'host' => env('FILESYSTEM_SFTP_HOST'),
			'username' => env('FILESYSTEM_SFTP_USERNAME'),
			'password' => env('FILESYSTEM_SFTP_PASSWORD'),
			'port' => env('FILESYSTEM_SFTP_PORT', 21),
			'root' => env('FILESYSTEM_SFTP_ROOT'),
			'privateKey' => env('SFTP_PRIVATE_KEY'),
			'passphrase' => env('SFTP_PASSPHRASE'),
			'maxTries' => '4',
			'timeout' => '30',
			'useAgent' => '1',
			'hostFingerprint' => env('FILESYSTEM_SFTP_HOST_FINGERPRINT'),
		],
		's3' => [
			'driver' => 's3',
			'key' => env('AWS_ACCESS_KEY_ID'),
			'secret' => env('AWS_SECRET_ACCESS_KEY'),
			'region' => env('AWS_DEFAULT_REGION'),
			'bucket' => env('AWS_BUCKET'),
			'url' => env('AWS_URL'),
			'endpoint' => env('AWS_ENDPOINT'),
			'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
			'throw' => '',
		],
		'media' => [
			'key' => env('AWS_ACCESS_KEY_ID'),
			'url' => env('AWS_URL'),
			'throw' => 'false',
			'bucket' => 'martipansapte-media',
			'driver' => 's3',
			'region' => env('AWS_DEFAULT_REGION'),
			'secret' => env('AWS_SECRET_ACCESS_KEY'),
			'endpoint' => env('AWS_ENDPOINT'),
			'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
		],
		

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
