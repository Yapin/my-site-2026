<?php
class PsetSetupThemeView
{
    /**
     * headタグ内に直接記載するスタイルをまとめる
     */
    public static function echo_head_style()
    {
?>
        <style>
            /* adminバーの背景色変更 */
            #wpadminbar {
                background-color: #f16101;
            }
        </style>
    <?php
    }

    /**
     * 管理画面でのheadタグ内に直接記載するスタイルをまとめる
     */

    public static function echo_admin_head_style()
    {
    ?>
        <style>
            /* 管理画面のアドミンバーの背景色変更 */
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
    }
}
