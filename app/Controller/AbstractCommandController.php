<?php

declare(strict_types=1);

namespace App\Controller;

use Minicli\Command\CommandController;

abstract class AbstractCommandController extends CommandController
{
    protected function output(string $output, string $style = 'default',  bool $newLine = true): void
    {
        $this->getPrinter()->out($output, $style);
        if ($newLine) {
            $this->getPrinter()->newline();
        }
    }
}
