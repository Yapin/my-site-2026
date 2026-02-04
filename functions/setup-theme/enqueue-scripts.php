<?php

/**
 * 必要なスクリプトを読み込む
 */

function read_scripts()
{
    /* CSSファイル読み込み */
    wp_enqueue_style(MY_SNOW_MONKEY_STYLE_HANDLE, MY_SNOW_MONKEY_URL . '/assets/css/style.css', array(), filemtime(MY_SNOW_MONKEY_PATH . '/assets/css/style.css'));
}
add_action('wp_enqueue_scripts', 'read_scripts');
