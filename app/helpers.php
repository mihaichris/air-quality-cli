<?php

use Minicli\Input;

function input(string $prompt = 'Input Value:'): \Minicli\Input
{
    return new Input($prompt);
}
