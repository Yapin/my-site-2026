<?php
class PsetHookAction
{
    public static function init()
    {
        add_action('wp_head', [PsetSetupThemeFunc::class, 'add_head_css']);
        add_action('admin_head', [PsetSetupThemeFunc::class, 'add_admin_head_css']);
        add_action('wp_enqueue_scripts', [PsetSetupThemeFunc::class, 'read_scripts']);
    }
}
