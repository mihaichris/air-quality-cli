<?php

namespace App\Command\Current;

use Air\Quality\AirQuality;
use InvalidArgumentException;
use Minicli\Command\CommandController;

final class DefaultController extends CommandController
{
    public function handle(): void
    {
        $latitude = $this->getParam('latitude');
        $longitude = $this->getParam('longitude');
        if ($latitude === null) {
            throw new InvalidArgumentException('Latitude param not provided.');
        }

        if ($longitude === null) {
            throw new InvalidArgumentException('Longitute param not provided.');
        }

        $airQuality = new AirQuality((int)$latitude, (int)$longitude);
        $airQualityResponse = $airQuality->setTimezone('Europe/Bucharest')->getNow();
        $this->getPrinter()->newline();
        foreach ($airQualityResponse->hourly as $values) {
            foreach ($values as $weatherVariable => $value) {
                $unit = $airQualityResponse->units[$weatherVariable];
                $this->getPrinter()->out($weatherVariable . ': ' . ($value ?? 'NA') . ' ' . $unit, 'green');
                $this->getPrinter()->newline();
            }
        }
    }
}
