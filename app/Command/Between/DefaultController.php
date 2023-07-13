<?php

namespace App\Command\Between;

use Air\Quality\AirQuality;
use InvalidArgumentException;
use Minicli\Command\CommandController;
use Minicli\Output\Helper\TableHelper;

final class DefaultController extends CommandController
{
    public function handle(): void
    {
        if (!$this->hasParam('latitude')) {
            throw new InvalidArgumentException('Latitude param not provided.');
        }

        if (!$this->hasParam('longitude')) {
            throw new InvalidArgumentException('Longitute param not provided.');
        }

        if (!$this->hasParam('start_date')) {
            throw new InvalidArgumentException('Start date param not provided.');
        }

        if (!$this->hasParam('end_date')) {
            throw new InvalidArgumentException('End date param not provided.');
        }

        $airQuality = new AirQuality((int)$this->getParam('latitude'), (int)$this->getParam('longitude'));
        $airQualityResponse = $airQuality->setTimezone('Europe/Bucharest')->getBetweenDates((string)$this->getParam('start_date'), (string)$this->getParam('end_date'));
        $tableHelper = new TableHelper();
        $tableHelper->addHeader(['Date', ...array_keys($airQualityResponse->units)]);
        foreach ($airQualityResponse->hourly as $hour => $weatherVariables) {
            $tableHelper->addRow([$hour, ...array_map('strval', array_values($weatherVariables))]);
        }

        $this->out($tableHelper->getFormattedTable());
    }
}
