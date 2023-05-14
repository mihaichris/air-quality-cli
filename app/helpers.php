<?php

declare(strict_types=1);

use Minicli\Input;

/**
 * @return array<string, mixed[]>
 */
function config_default(string $configDir): array
{
    $config = [];

    /** @var array<string, mixed[]> $pathnames */
    $pathnames = glob($configDir . '/*.php');
    foreach ($pathnames as $pathname) {
        $configData = include $pathname;
        if (is_array($configData)) {
            $config = array_merge($config, $configData);
        }
    }

    return $config;
}

/**
 * @return array<string, mixed[]>
 */
function load_config(): array
{
    return config_default(__DIR__ . '/../config');
}

function env(string $key, string $defaultValue = null): string|null
{
    return getenv($key) ?: $defaultValue;
}

function config(string $key): mixed
{
    $config = load_config();

    return $config[$key] ?? null;
}

function input(string $prompt = 'Input Value:'): \Minicli\Input
{
    return new Input($prompt);
}
