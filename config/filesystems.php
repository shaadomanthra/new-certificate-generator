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

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
        ],

        'certificate_designs' => [
            'driver' => 'local',
            'root' => storage_path('app/certificate_designs'),
            'url' => env('APP_URL').'/certificate_designs',
            'visibility' => 'public',
        ],

        'fonts' => [
            'driver' => 'local',
            'root' => storage_path('app/fonts'),
            'url' => env('APP_URL').'/fonts',
            'visibility' => 'public',
        ],

        'certificate_templates' => [
            'driver' => 'local',
            'root' => storage_path('app/certificate_templates'),
            'url' => env('APP_URL').'/certificate_templates',
            'visibility' => 'public',
        ],
        'default_conf' => [
            'driver' => 'local',
            'root' => storage_path('app/default_conf'),
            'url' => env('APP_URL').'/default_conf',
            'visibility' => 'public',
        ],
        'logos' => [
            'driver' => 'local',
            'root' => storage_path('app/logos'),
            'url' => env('APP_URL').'/logos',
            'visibility' => 'public',
        ],
        'signatures' => [
            'driver' => 'local',
            'root' => storage_path('app/signatures'),
            'url' => env('APP_URL').'/signatures',
            'visibility' => 'public',
        ],
        'tmp' => [
            'driver' => 'local',
            'root' => storage_path('app/tmp'),
            'url' => env('APP_URL').'/tmp',
            'visibility' => 'public',
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
        public_path('certificate_designs') => storage_path('app/certificate_designs'),
        public_path('fonts') => storage_path('app/fonts'),
        public_path('certificate_templates') => storage_path('app/certificate_templates'),
        public_path('default_conf') => storage_path('app/default_conf'),
        public_path('logos') => storage_path('app/logos'),
        public_path('signatures') => storage_path('app/signatures'),
        public_path('tmp') => storage_path('app/tmp'),
    ],

];
