<?php

namespace App\Command\Help;

use App\Controller\AbstractCommandController;
use Minicli\App;

final class DefaultController extends AbstractCommandController
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
            $this->getPrinter()->newline();
            $this->output($command, 'info_alt', true);
            $this->getPrinter()->newline();
        }
    }
}
