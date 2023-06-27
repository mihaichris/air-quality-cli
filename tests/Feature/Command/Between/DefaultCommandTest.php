<?php

test('execute without latitude params will throw exception', function () {
    app()->runCommand(['air-quality', 'between', 'longitude=26.14']);
})->expectExceptionMessage('Latitude param not provided.');

test('execute without longitude params will throw exception', function () {
    app()->runCommand(['air-quality', 'between', 'latitude=44.38']);
})->expectExceptionMessage('Longitute param not provided.');

test('execute without start_date params will throw exception', function () {
    app()->runCommand(['air-quality', 'between', 'latitude=44.38', 'longitude=26.14', 'start_date=2023-05-27']);
})->expectExceptionMessage('End date param not provided.');

test('execute without end_date params will throw exception', function () {
    app()->runCommand(['air-quality', 'between', 'latitude=44.38', 'longitude=26.14', 'end_date=2023-05-28']);
})->expectExceptionMessage('Start date param not provided.');

test('execute without all params will throw exception', function () {
    app()->runCommand(['air-quality', 'between']);
})->expectException(InvalidArgumentException::class);

test('execute with params will not ask for prompts', function () {
    app()->runCommand(['air-quality', 'between', 'latitude=44.38', 'longitude=26.14', 'start_date=2023-05-27', 'end_date=2023-05-28']);
})->expectNotToPerformAssertions();

test('execute with params and not filter will return table with all weather variables', function (string $expectedWeatherVariable) {
    app()->runCommand(['air-quality', 'between', 'latitude=44.38', 'longitude=26.14', 'start_date=2023-05-27', 'end_date=2023-05-28']);
    $this->expectOutputRegex('/' . str_replace(['(', ')'], ['\(', '\)'], $expectedWeatherVariable) . '/');
})->with('weather_variables');
