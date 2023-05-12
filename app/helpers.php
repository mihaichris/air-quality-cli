<?php

declare(strict_types=1);

use Minicli\Input;

function config_default(string $config_dir): array
{
    $config = [];

    foreach (glob($config_dir . '/*.php') as $config_file) {
        $config_data = include $config_file;
        if (is_array($config_data)) {
            $config = array_merge($config, $config_data);
        }
    }

    return $config;
}

function load_config(): array
{
    return array_merge(config_default(__DIR__ . '/../config'), include __DIR__ . '/../config.php');
}

function env(string $key, string $defaultValue = null): string|null
{
    return getenv($key) ? getenv($key) : $defaultValue;
}

function input(string $prompt = 'Input Value:'): \Minicli\Input
{
    return new Input($prompt);
}
