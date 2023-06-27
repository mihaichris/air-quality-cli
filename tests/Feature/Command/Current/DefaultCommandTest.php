<?php

test('execute without latitude params will throw exception', function () {
    app()->runCommand(['air-quality', 'current', 'longitude=26.14']);
})->expectExceptionMessage('Latitude param not provided.');

test('execute without longitude params will throw exception', function () {
    app()->runCommand(['air-quality', 'current', 'latitude=44.38']);
})->expectExceptionMessage('Longitute param not provided.');

test('execute without all params will throw exception', function () {
    app()->runCommand(['air-quality', 'current']);
})->expectException(InvalidArgumentException::class);

test('execute with params will not ask for prompts', function () {
    app()->runCommand(['air-quality', 'current', 'latitude=44.38', 'longitude=26.14']);
})->expectNotToPerformAssertions();

test('execute with params and not filter will return table with all weather variables', function (string $expectedWeatherVariable) {
    app()->runCommand(['air-quality', 'current', 'latitude=44.38', 'longitude=26.14']);
    $this->expectOutputRegex('/' . str_replace(['(', ')'], ['\(', '\)'], $expectedWeatherVariable) . '/');
})->with('weather_variables');
