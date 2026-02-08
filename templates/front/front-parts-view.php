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
        $catch_raw = isset($args['catch']) ? $args['catch'] : 'あなたのキャッチコピー';
        $catch     = esc_html($catch_raw);
        // PCのみ「、」で改行（SPではCSSでbrを非表示にする）
        $catch = str_replace('、', '<br>', $catch);
        $sub   = isset($args['sub']) ? esc_html($args['sub']) : 'サブコピー';

        ob_start();
?>

        <section class="mv mv--abstract" role="banner" aria-label="Main Visual">
            <!-- 背面: パーティクル用 canvas -->
            <canvas id="myCanvas" class="mv__canvas" width="1024" height="768" aria-hidden="true"></canvas>

            <!-- 前面: テキスト（背景透過で後ろのキラキラが通る） -->
            <div class="mv__inner">
                <h1 class="mv__catch"><?php echo $catch; ?></h1>
                <p class="mv__sub"><?php echo $sub; ?></p>
            </div>
        </section>

<?php
        $output = ob_get_clean();
        return $output;
    }
}
