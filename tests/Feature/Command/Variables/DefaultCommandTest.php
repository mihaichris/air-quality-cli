<?php

test('will return all weather variables', function (string $expectedWeatherVariable) {
    app()->runCommand(['air-quality', 'variables']);
    $this->expectOutputRegex('/' . str_replace(['(', ')'], ['\(', '\)'], $expectedWeatherVariable) . '/');
})->with('weather_variables');

test('will return all weather variables codes', function (string $weatherVariableCode) {
    app()->runCommand(['air-quality', 'variables']);
    $this->expectOutputRegex('/' . $weatherVariableCode . '/');
})->with('weather_variables_codes');
