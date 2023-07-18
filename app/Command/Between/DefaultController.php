<?php

declare(strict_types=1);

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

        $airQuality = new AirQuality((float)$this->getParam('latitude'), (float)$this->getParam('longitude'));

        if ($this->hasParam('variables')) {
            $weatherVariables = explode(',', (string)$this->getParam('variables'));
            $availableWeatherVariables =  array_keys($airQuality->getWeatherVariables());
            $invalidWeatherVariables = array_filter($weatherVariables, static fn (string $weatherVariable): bool => !in_array($weatherVariable, $availableWeatherVariables));
            if ($invalidWeatherVariables !== []) {
                throw new InvalidArgumentException('Input weather variables are not valid: ' . implode(',', $invalidWeatherVariables));
            }
        }

        if (!empty($weatherVariables)) {
            $airQuality->with($weatherVariables);
        }

        $airQualityResponse = $airQuality->setTimezone('Europe/Bucharest')->getBetweenDates((string)$this->getParam('start_date'), (string)$this->getParam('end_date'));
        $tableHelper = new TableHelper();
        $tableHelper->addHeader(['Date', ...array_keys($airQualityResponse->units)]);
        foreach ($airQualityResponse->hourly as $hour => $weatherVariables) {
            $tableHelper->addRow([$hour, ...array_map('strval', array_values($weatherVariables))]);
        }

        $this->out($tableHelper->getFormattedTable());
    }
}
