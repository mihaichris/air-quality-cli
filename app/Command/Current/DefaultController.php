<?php

namespace App\Command\Current;

use Air\Quality\AirQuality;
use InvalidArgumentException;
use Minicli\Command\CommandController;
use Minicli\Output\Filter\ColorOutputFilter;
use Minicli\Output\Helper\TableHelper;

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
        $tableHelper = new TableHelper();
        $tableHelper->addHeader(['datetime', ...array_keys($airQualityResponse->units), 'units']);
        foreach ($airQualityResponse->hourly as $dateTime => $values) {
            $tableHelper->addRow([$dateTime, ...array_map('strval', array_values($values)), '']);
        }

        $this->getPrinter()->newline();
        $this->getPrinter()->rawOutput($tableHelper->getFormattedTable(new ColorOutputFilter()));
        $this->getPrinter()->newline();
    }
}
