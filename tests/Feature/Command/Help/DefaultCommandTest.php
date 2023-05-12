<?php

test('the "help" command prints the command tree', function () {
    app()->runCommand(['air-quality', 'help']);
})->expectOutputRegex('/(current)|(help)/');
