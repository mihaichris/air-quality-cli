<?php

namespace App\Command\Help;

use Minicli\App;
use Minicli\Command\CommandController;

final class DefaultController extends CommandController
{
    /** @var array<string, array<string, string>> */
    private array $commandMap = [];

    public function boot(App $app): void
    {
        parent::boot($app);
        $this->commandMap = $app->commandRegistry->getCommandMap();
    }

    public function handle(): void
    {
        $this->getPrinter()->info('Available Commands: ');
        foreach (array_keys($this->commandMap) as $command) {
            $this->getPrinter()->info($command);
        }
    }
}
