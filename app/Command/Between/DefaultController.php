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
        $latitude = $this->getParam('latitude');
        $longitude = $this->getParam('longitude');
        $startDate = $this->getParam('start_date');
        $endDate = $this->getParam('end_date');
        if ($latitude === null) {
            throw new InvalidArgumentException('Latitude param not provided.');
        }

        if ($longitude === null) {
            throw new InvalidArgumentException('Longitute param not provided.');
        }

        if ($startDate === null) {
            throw new InvalidArgumentException('Start date param not provided.');
        }

        if ($endDate === null) {
            throw new InvalidArgumentException('End date param not provided.');
        }

        $airQuality = new AirQuality((int)$latitude, (int)$longitude);
        $airQualityResponse = $airQuality->setTimezone('Europe/Bucharest')->getBetweenDates($startDate, $endDate);
        $tableHelper = new TableHelper();
        $tableHelper->addHeader(['Date', ...array_keys($airQualityResponse->units)]);
        foreach ($airQualityResponse->hourly as $hour => $weatherVariables) {
            $tableHelper->addRow([$hour, ...array_map('strval', array_values($weatherVariables))]);
        }

        $this->out($tableHelper->getFormattedTable());
    }
}
