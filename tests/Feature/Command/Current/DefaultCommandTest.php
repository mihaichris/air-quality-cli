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

test('execute with params and not filter will return table with datetime column and units column', function () {
    app()->runCommand(['air-quality', 'current', 'latitude=44.38', 'longitude=26.14']);
})->expectOutputRegex('/(datetime)|(units)/');

test('execute with params and not filter will return table with all weather variables', function () {
    app()->runCommand(['air-quality', 'current', 'latitude=44.38', 'longitude=26.14']);
    $weatherVariables = ['pm10', 'pm2_5', 'carbon_monoxide', 'nitrogen_dioxide', 'sulphur_dioxide', 'ozone', 'aerosol_optical_depth', 'dust', 'uv_index', 'uv_index_clear_sky', 'ammonia', 'alder_pollen', 'birch_pollen', 'grass_pollen', 'mugwort_pollen', 'olive_pollen', 'ragweed_pollen'];
    $expectOutputRegex = [];
    foreach ($weatherVariables as $weatherVariable) {
        $expectOutputRegex[] = '(' . $weatherVariable . ')';
    }
    $this->expectOutputRegex('/' . implode('|', $expectOutputRegex) . '/');
});
