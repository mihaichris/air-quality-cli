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

test('execute with params and not filter will return table with all weather variables', function () {
    app()->runCommand(['air-quality', 'between', 'latitude=44.38', 'longitude=26.14', 'start_date=2023-05-27', 'end_date=2023-05-28']);
    $weatherVariables = ['Particulate Matter (PM10)', 'Particulate Matter (PM2.5)', 'Carbon Monoxide', 'Nitrogen Dioxide', 'Sulphur Dioxide', 'Ozone', 'Aerosol Optical Depth', 'Dust', 'UV Index', 'UV Index Clear Sky', 'Ammonia', 'Alder Pollen', 'Birch Pollen', 'Grass Pollen', 'Mugwort Pollen', 'Olive Pollen', 'Ragweed Pollen'];
    foreach ($weatherVariables as $expectedWeatherVariable) {
        $this->assertStringContainsString($expectedWeatherVariable, $this->getActualOutputForAssertion());
    }
});

test('execute with params and filtered by ozone will return table with only ozone weather variable', function () {
    /** @var TestCase $this */
    app()->runCommand(['air-quality', 'between', 'variables=ozone', 'latitude=44.38', 'longitude=26.14', 'start_date=2023-05-27', 'end_date=2023-05-28']);
    $weatherVariables = ['Particulate Matter (PM10)', 'Particulate Matter (PM2.5)', 'Carbon Monoxide', 'Nitrogen Dioxide', 'Sulphur Dioxide', 'Aerosol Optical Depth', 'Dust', 'UV Index', 'UV Index Clear Sky', 'Ammonia', 'Alder Pollen', 'Birch Pollen', 'Grass Pollen', 'Mugwort Pollen', 'Olive Pollen', 'Ragweed Pollen'];
    foreach ($weatherVariables as $notExpectedWeatherVariable) {
        $this->assertStringNotContainsString($notExpectedWeatherVariable, $this->getActualOutputForAssertion());
    }
});

test('execute with params and filtered by non valid weather variable will throw exception', function () {
    /** @var TestCase $this */
    app()->runCommand(['air-quality', 'between', 'variables=test', 'latitude=44.38', 'longitude=26.14', 'start_date=2023-05-27', 'end_date=2023-05-28']);
})->expectException(InvalidArgumentException::class);
