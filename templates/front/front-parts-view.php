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
        $sub   = isset($args['sub']) ? esc_html($args['sub']) : 'サブコピー';

        // 「〇〇〇」が含まれている場合は、その部分をアニメーション用のテキストに置き換える
        $has_placeholder = (false !== mb_strpos($catch_raw, '〇〇〇'));

        if ($has_placeholder) {
            $parts       = explode('〇〇〇', $catch_raw, 2);
            $before_raw  = $parts[0];
            $after_raw   = isset($parts[1]) ? $parts[1] : '';

            $catch_before = esc_html($before_raw);
            $catch_after  = esc_html($after_raw);

            // PCのみ「、」で改行（SPではCSSでbrを非表示にする）
            $catch_before = str_replace('、', '<br>', $catch_before);
            $catch_after  = str_replace('、', '<br>', $catch_after);
        } else {
            $catch = esc_html($catch_raw);
            // PCのみ「、」で改行（SPではCSSでbrを非表示にする）
            $catch = str_replace('、', '<br>', $catch);
        }

        ob_start();
?>

        <section class="mv mv--abstract" role="banner" aria-label="Main Visual">
            <!-- 背面: パーティクル用 canvas -->
            <canvas id="myCanvas" class="mv__canvas" width="1024" height="768" aria-hidden="true"></canvas>

            <!-- 前面: テキスト（背景透過で後ろのキラキラが通る） -->
            <div class="mv__inner">
                <h1 class="mv__catch">
                    <?php if ($has_placeholder) : ?>
                        <?php echo $catch_before; ?>
                        <span class="mv__rotate">
                            <span class="active">場所</span>
                            <span>空間</span>
                            <span>環境</span>
                            <span>時間</span>
                            <span>きっかけ</span>
                        </span>
                        <?php echo $catch_after; ?>
                    <?php else : ?>
                        <?php echo $catch; ?>
                    <?php endif; ?>
                </h1>
                <p class="mv__sub"><?php echo $sub; ?></p>
            </div>
        </section>

<?php
        $output = ob_get_clean();
        return $output;
    }
}
