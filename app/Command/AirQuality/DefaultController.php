<?php

namespace App\Command\AirQuality;

use Air\Quality\AirQuality;
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
            $latitude = input('Latitude: ')->read();
        }

        if ($longitude === null) {
            $longitude = input('Longitude: ')->read();
        }

        $airQuality = new AirQuality($latitude, $longitude);
        $airQualityResponse = $airQuality->getNow();
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
