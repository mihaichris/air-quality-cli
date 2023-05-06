<?php

test('default command "aq" is correctly loaded', function () {
    app()->runCommand(['minicli', 'airquality']);
})->expectOutputRegex('/help/');
