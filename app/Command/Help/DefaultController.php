<?php

namespace App\Command\Help;

use App\Controller\AbstractCommandController;
use Minicli\App;
use Minicli\Command\CommandController;

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
        foreach ($this->commandMap as $command => $sub) {
            $this->getPrinter()->newline();
            $this->output($command, 'info_alt', true);
            foreach ($sub as $subcommand) {
                if ($subcommand !== 'default') {
                    $this->getPrinter()->newline();
                    $this->getPrinter()->out(sprintf('%s%s', '└──', $subcommand));
                }
            }

            $this->getPrinter()->newline();
        }
    }
}
