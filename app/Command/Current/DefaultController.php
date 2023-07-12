<?php

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

        $latitude = $this->getParam('latitude');
        $longitude = $this->getParam('longitude');
        $airQuality = new AirQuality((int)$latitude, (int)$longitude);
        $airQualityResponse = $airQuality->setTimezone('Europe/Bucharest')->getNow();
        foreach ($airQualityResponse->hourly as $values) {
            foreach ($values as $weatherVariable => $value) {
                $unit = $airQualityResponse->units[$weatherVariable];
                $this->out($weatherVariable . ': ' . ($value ?? 'NA') . ' ' . $unit, 'green');
                $this->newline();
            }
        }
    }
}
