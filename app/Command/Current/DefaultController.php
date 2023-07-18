<?php

declare(strict_types=1);

namespace App\Command\Current;

use Air\Quality\AirQuality;
use InvalidArgumentException;
use Minicli\Command\CommandController;

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

        $airQuality = new AirQuality((float)$this->getParam('latitude'), (float)$this->getParam('longitude'));
        if ($this->hasParam('variables')) {
            $weatherVariables = explode(',', (string)$this->getParam('variables'));
            $availableWeatherVariables =  array_keys($airQuality->getWeatherVariables());
            $invalidWeatherVariables = array_filter($weatherVariables, static fn (string $weatherVariable): bool => !in_array($weatherVariable, $availableWeatherVariables));
            if ($invalidWeatherVariables !== []) {
                throw new InvalidArgumentException('Input weather variables are not valid: ' . implode(',', $invalidWeatherVariables));
            }
        }

        $airQualityResponse = $airQuality->setTimezone('Europe/Bucharest');
        if (!empty($weatherVariables)) {
            $airQuality->with($weatherVariables);
        }

        $airQualityResponse = $airQuality->getNow();
        foreach ($airQualityResponse->hourly as $values) {
            foreach ($values as $weatherVariable => $value) {
                $unit = $airQualityResponse->units[$weatherVariable];
                $this->out($weatherVariable . ': ' . ($value ?? 'NA') . ' ' . $unit, 'green');
                $this->newline();
            }
        }
    }
}
