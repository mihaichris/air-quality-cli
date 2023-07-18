<?php

declare(strict_types=1);

return [
    /****************************************************************************
     * Air Quality Settings
     * You shouldn't need to change the next settings,
     * but you are free to do so at your own risk.
     *****************************************************************************/
    'app_path' => [
        __DIR__ . '/../app/Command',
        '@minicli/command-help'
    ],
    'theme' => 'App\Theme\Green',
    'debug' => true,
];
