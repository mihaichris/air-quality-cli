<?php

namespace App\Theme;

use Minicli\Output\Theme\DefaultTheme;
use Minicli\Output\CLIColors;

class GreenTheme extends DefaultTheme
{
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
