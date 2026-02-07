<?php
class PsetFrontPartsView
{
    /**
     * メインビジュアルを表示する
     *
     * @param array $args 'catch' と 'sub' でキャッチ・サブコピーを指定可能。未指定時はデフォルト文言を使用。
     * @return string
     */
    public static function get_mv($args = [])
    {
        $catch = isset($args['catch']) ? esc_html($args['catch']) : '輝ける未来を創り、人々を笑顔にする';
        $sub   = isset($args['sub'])   ? esc_html($args['sub'])   : 'クリエイティブなホスピタリティで伴走するDXデザイナー';

        ob_start();
?>
        <section class="mv mv--abstract" role="banner" aria-label="Main Visual">
            <div class="mv__inner">
                <h1 class="mv__catch"><?php echo $catch; ?></h1>
                <p class="mv__sub"><?php echo $sub; ?></p>
            </div>

            <!-- Sparkles (bokeh lights) -->
            <span class="mv__sparkle mv__sparkle--1" aria-hidden="true"></span>
            <span class="mv__sparkle mv__sparkle--2" aria-hidden="true"></span>
            <span class="mv__sparkle mv__sparkle--3" aria-hidden="true"></span>
            <span class="mv__sparkle mv__sparkle--4" aria-hidden="true"></span>
            <span class="mv__sparkle mv__sparkle--5" aria-hidden="true"></span>
            <span class="mv__sparkle mv__sparkle--6" aria-hidden="true"></span>
        </section>
<?php
        $output = ob_get_clean();
        return $output;
    }
}
