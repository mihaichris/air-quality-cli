<?php

namespace App\Theme;

use Minicli\Output\Theme\DefaultTheme;
use Minicli\Output\CLIColors;

final class GreenTheme extends DefaultTheme
{
    /**
     * @return array{default: mixed[], alt: mixed[], info: mixed[], info_alt: mixed[]}
     */
    public function getThemeColors(): array
    {
        return [
            'default'     => [CLIColors::$FG_GREEN],
            'alt'         => [CLIColors::$FG_BLACK, CLIColors::$BG_GREEN],
            'info'        => [CLIColors::$FG_WHITE],
            'info_alt'    => [CLIColors::$FG_WHITE, CLIColors::$BG_GREEN]
        ];
    }
}
