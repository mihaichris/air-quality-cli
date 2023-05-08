<?php

use Minicli\Input;

function input(string $prompt = 'Input Value:')
{
    return new Input($prompt);
}
