<?php
class PsetHookFilter
{
    public static function init()
    {
        add_filter('body_class', [PsetSetupThemeFunc::class, 'add_page_class']);
        add_filter('snow_monkey_forms/turnstile/theme', [PsetSetupThemeFunc::class, 'change_turnstile_theme']);
    }
}
