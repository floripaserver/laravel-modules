<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Module Namespace
    |--------------------------------------------------------------------------
    |
    | Default module namespace.
    |
    */

    'namespace' => 'App\Modules',

    /*
    |--------------------------------------------------------------------------
    | Module Stubs
    |--------------------------------------------------------------------------
    |
    | Default module stubs.
    |
    */

    'stubs' => [
        'enabled' => false,
        'path' => base_path(__DIR__ . '/../src/Commands/stubs'),
        'files' => [
            'routes/web' => 'Routes/web.php',
            'routes/api' => 'Routes/api.php',
            'module' => 'module.json',
            'views/index' => 'Resources/views/index.blade.php',
            'views/master' => 'Resources/views/layouts/master.blade.php',
            'scaffold/config' => 'Config/config.php',
            'composer' => 'composer.json'
        ],
        'replacements' => [
            'routes/web' => ['LOWER_NAME', 'STUDLY_NAME', 'MODULE_NAMESPACE'],
        	'routes/api' => ['LOWER_NAME', 'STUDLY_NAME', 'MODULE_NAMESPACE'],
            'module' => ['LOWER_NAME', 'STUDLY_NAME', 'MODULE_NAMESPACE'],
            'views/index' => ['LOWER_NAME'],
            'views/master' => ['STUDLY_NAME'],
            'scaffold/config' => ['STUDLY_NAME'],
            'composer' => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'VENDOR',
                'AUTHOR_NAME',
                'AUTHOR_EMAIL',
                'MODULE_NAMESPACE'
            ]
        ]
    ],
    'paths' => [
        /*
        |--------------------------------------------------------------------------
        | Modules path
        |--------------------------------------------------------------------------
        |
        | This path used for save the generated module. This path also will added
        | automatically to list of scanned folders.
        |
        */

        'modules' => base_path('app/Modules'),
        /*
        |--------------------------------------------------------------------------
        | Modules assets path
        |--------------------------------------------------------------------------
        |
        | Here you may update the modules assets path.
        |
        */

        'assets' => public_path('modules'),
        /*
        |--------------------------------------------------------------------------
        | The migrations path
        |--------------------------------------------------------------------------
        |
        | Where you run 'module:publish-migration' command, where do you publish the
        | the migration files?
        |
        */

        'migration' => base_path('database/migrations'),
        /*
        |--------------------------------------------------------------------------
        | The seeds path
        |--------------------------------------------------------------------------
        |
        | Where you run 'module:publish-seed' command, where do you publish the
        | the seed files?
        |
        */

        'seed' => base_path('database/seeds'),
        /*
        |--------------------------------------------------------------------------
        | Generator path
        |--------------------------------------------------------------------------
        |
        | Here you may update the modules generator path.
        |
        */

        'generator' => [
            'asset' => 'Resources/assets',
            'config' => 'Config',
            'command' => 'Console',
            'event' => 'Events',
            'listener' => 'Events/Handlers',
            'migration' => 'Database/Migrations',
            'model' => 'Models',
            'repository' => 'Repositories',
            'seed' => 'Database/Seeds',
            'controller' => 'Http/Controllers',
            'middleware' => 'Http/Middleware',
            'request' => 'Http/Requests',
            'provider' => 'Providers',
            'lang' => 'Resources/lang',
            'view' => 'Resources/views',
            'test' => 'Tests',
            'job' => 'Jobs',
            'email' => 'Emails',
            'notification' => 'Notifications',
            'route' => 'Routes'
        ]
    ],
    /*
    |--------------------------------------------------------------------------
    | Scan Path
    |--------------------------------------------------------------------------
    |
    | Here you define which folder will be scanned. By default will scan vendor
    | directory. This is useful if you host the package in packagist website.
    |
    */

    'scan' => [
        'enabled' => false,
        'paths' => [
            base_path('vendor/*/*')
        ]
    ],
    /*
    |--------------------------------------------------------------------------
    | Composer File Template
    |--------------------------------------------------------------------------
    |
    | Here is the config for composer.json file, generated by this package
    |
    */

    'composer' => [
        'vendor' => 'llama-laravel-modules',
        'author' => [
            'name' => 'XuaNguyen',
            'email' => 'xuan.0211@gmail.com'
        ]
    ],
    /*
    |--------------------------------------------------------------------------
    | Caching
    |--------------------------------------------------------------------------
    |
    | Here is the config for setting up caching feature.
    |
    */
    'cache' => [
        'enabled' => false,
        'key' => 'llama-laravel-modules',
        'lifetime' => 60
    ],
    /*
    |--------------------------------------------------------------------------
    | Choose what laravel-modules will register as custom namespaces.
    | Setting one to false will require to register that part
    | in your own Service Provider class.
    |--------------------------------------------------------------------------
    */
    'register' => [
        'translations' => true
    ],
];
