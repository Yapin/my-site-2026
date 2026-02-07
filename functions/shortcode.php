<?php
class PsetShortcode
{
    public static function init()
    {
        add_shortcode('mv', [PsetShortcode::class, 'mv_shortcode']);
    }

    /**
     * メインビジュアルを表示するショートコード
     *
     * 使用例: [mv] または [mv catch="キャッチコピー" sub="サブコピー"]
     *
     * @param array|string $atts   ショートコードの属性（連想配列）
     * @param string       $content 囲みコンテンツ（未使用）
     * @param string       $tag    ショートコード名
     * @return string
     */
    public static function mv_shortcode($atts, $content, $tag)
    {
        $defaults = [
            'catch' => '輝ける未来を創り、人々を笑顔にする',
            'sub'   => 'クリエイティブなホスピタリティで伴走するDXデザイナー',
        ];
        $atts = shortcode_atts($defaults, $atts, $tag);
        return PsetFrontPartsView::get_mv($atts);
    }
}
