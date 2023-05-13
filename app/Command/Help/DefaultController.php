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
        foreach ($this->commandMap as $command => $sub) {
            $this->getPrinter()->newline();
            $this->output($command, 'info_alt', true);
            foreach ($sub as $subcommand) {
                if ($subcommand !== 'default') {
                    $this->output(sprintf('%s%s', '└──', $subcommand), newLine: true);
                }
            }

            $this->getPrinter()->newline();
        }
    }
}
