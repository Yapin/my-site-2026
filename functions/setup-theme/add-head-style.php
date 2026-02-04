<?php

/**
 * headタグ内に直接記載するスタイルをまとめる
 */
add_action('wp_head', 'cap_add_head_css');
function cap_add_head_css()
{
    if (strpos(home_url(), 'staging') !== false || strpos(home_url(), 'local') !== false || strpos(home_url(), 'develop') !== false) :
?>
        <style>
            #wpadminbar {
                background-color: #f16101;
            }
        </style>
    <?php
    endif;
}
/**
 * 管理画面のアドミンバーの背景色変更
 */
add_action('admin_head', function () {
    if (strpos(home_url(), 'staging') !== false || strpos(home_url(), 'local') !== false || strpos(home_url(), 'develop') !== false) :
    ?>
        <style>
            #wpadminbar {
                background: #f16101;
            }

            #wpadminbar .ab-item,
            #wpadminbar a.ab-item,
            #wpadminbar>#wp-toolbar span.ab-label,
            #wpadminbar>#wp-toolbar span.noticon {
                color: #fff;
            }
        </style>
<?php
    endif;
});
