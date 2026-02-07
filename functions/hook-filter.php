<?php
class PsetHookFilter
{
    public static function init()
    {
        add_filter('body_class', [PsetSetupThemeFunc::class, 'add_page_class']);
    }
}
