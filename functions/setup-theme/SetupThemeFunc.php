<?php
class PsetSetupThemeFunc
{
    private const MY_SNOW_MONKEY_STYLE_HANDLE = 'my-snow-monkey-style';

    /**
     * headタグ内に直接記載するスタイル
     */
    public static function add_head_css()
    {
        if (strpos(home_url(), 'staging') !== false || strpos(home_url(), 'local') !== false || strpos(home_url(), 'develop') !== false) {
            PsetSetupThemeView::echo_head_style();
        }
    }

    /**
     * 管理画面でのheadタグ内に直接記載するスタイル
     */
    public static function add_admin_head_css()
    {
        if (strpos(home_url(), 'staging') !== false || strpos(home_url(), 'local') !== false || strpos(home_url(), 'develop') !== false) {
            PsetSetupThemeView::echo_admin_head_style();
        }
    }
    /**
     * 必要なスクリプトを読み込む
     */

    public static function read_scripts()
    {
        /* CSSファイル読み込み */
        wp_enqueue_style(self::MY_SNOW_MONKEY_STYLE_HANDLE, MY_SNOW_MONKEY_URL . '/assets/css/style.css', array(), filemtime(MY_SNOW_MONKEY_PATH . '/assets/css/style.css'));
        // [mv] ショートコードは任意のページで使えるため、フロントでは常に読み込む（#mv-particles が無いページでは JS が何もしない）
        if (is_front_page()) {
            // wp_enqueue_script('tsparticles', 'https://cdn.jsdelivr.net/npm/tsparticles@3/tsparticles.bundle.min.js', [], null, true);
            // wp_enqueue_script('mv-particles', MY_SNOW_MONKEY_URL . '/assets/js/mv-particles.js', ['tsparticles'], '1.0.1', true);
            wp_enqueue_script('createjs', 'https://code.createjs.com/1.0.0/createjs.min.js', [], null, true);
            wp_enqueue_script('particlejs', 'https://cdn.rawgit.com/ics-creative/ParticleJS/release/1.0.0/libs/particlejs.min.js', [], null, true);
            wp_enqueue_script('mv-particles', MY_SNOW_MONKEY_URL . '/assets/js/mv-particles.js', ['createjs', 'particlejs'], '1.0.1', true);
        }
        wp_enqueue_script('contact-form', MY_SNOW_MONKEY_URL . '/assets/js/contact-form.js', [], '1.0.1', true);
    }
    /**
     * ページのスラッグを body タグの class に付与する
     * カスタム投稿タイプ用の class が必要な場合は、is_singular( array( 'your_post_type' ) ) を追加してください
     */
    public static function add_page_class($classes)
    {
        if (is_page()) {
            $page = get_post();
            $classes[] = $page->post_name;
        }
        return $classes;
    }
}
