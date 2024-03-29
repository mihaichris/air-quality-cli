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

test('execute with params and not filter will return table with all weather variables', function () {
    app()->runCommand(['air-quality', 'current', 'variables=ozone', 'latitude=44.38', 'longitude=26.14']);
    $weatherVariables = ['Particulate Matter (PM10)', 'Particulate Matter (PM2.5)', 'Carbon Monoxide', 'Nitrogen Dioxide', 'Sulphur Dioxide', 'Aerosol Optical Depth', 'Dust', 'UV Index', 'UV Index Clear Sky', 'Ammonia', 'Alder Pollen', 'Birch Pollen', 'Grass Pollen', 'Mugwort Pollen', 'Olive Pollen', 'Ragweed Pollen'];
    foreach ($weatherVariables as $expectedWeatherVariable) {
        $this->assertStringNotContainsString($expectedWeatherVariable, $this->getActualOutputForAssertion());
    }
});

test('execute with params and filtered by non valid weather variable will throw exception', function () {
    /** @var TestCase $this */
    app()->runCommand(['air-quality', 'current', 'variables=test', 'latitude=44.38', 'longitude=26.14']);
})->expectException(InvalidArgumentException::class);
