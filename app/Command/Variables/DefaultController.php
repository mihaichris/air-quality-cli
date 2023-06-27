<?php

namespace App\Command\Variables;

use Air\Quality\AirQuality;
use Minicli\Command\CommandController;
use Minicli\Output\Filter\ColorOutputFilter;
use Minicli\Output\Helper\TableHelper;
use Minicli\Output\Theme\DaltonTheme;

final class DefaultController extends CommandController
{
    public function handle(): void
    {
        $airQuality = new AirQuality(0, 0);
        $weatherVariables = $airQuality->getWeatherVariables();
        $tableHelper = new TableHelper();
        $this->display('Available Weather Variables');
        $tableHelper->addHeader(['Name', 'Code']);
        foreach ($weatherVariables as $code => $name) {
            $tableHelper->addRow([$name, $code]);
        }

        $this->out($tableHelper->getFormattedTable(new ColorOutputFilter(new DaltonTheme())));
    }
}
