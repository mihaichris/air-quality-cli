<?php

namespace App\Command\Between;

use Air\Quality\AirQuality;
use InvalidArgumentException;
use Minicli\Command\CommandController;

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
            throw new InvalidArgumentException('start_date param not provided.');
        }
        if ($endDate === null) {
            throw new InvalidArgumentException('end_date param not provided.');
        }

        $airQuality = new AirQuality((int)$latitude, (int)$longitude);
        $airQualityResponse = $airQuality->setTimezone('Europe/Bucharest')->getBetweenDates($startDate, $endDate);
    }
}
