<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Modules path
    |--------------------------------------------------------------------------
    |
    | This value is the path to the modules. We use this for injecting the
    | modules into the framework.
    |
    */
    'modules_path' => env('DDD_MODULES_PATH', app_path()),

    /*
    |--------------------------------------------------------------------------
    | Exclude paths
    |--------------------------------------------------------------------------
    |
    | This value is for excluding paths to search for modules. For example: if
    | you use the app_path() on a default Laravel project, you need to exclude
    | all the folders that are not a module.
    |
    */
    'exclude_paths' => [
        '/Core',
        '/Providers'
    ],
];