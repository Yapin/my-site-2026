# 2026 年版自社サイト

テーマは「SNOW MONKEY」、カスタマイズは「My Snow Monkey」で行います。

## 環境構築

## ブランチ

- `main` 安定して動作する、開発の中心となるブランチ。
- `staging` ステージング環境のブランチ。**`push` されるとステージング環境（wp/staging/wp-content/plugins/my-snow-monkey/）へデプロイされる**
- `production` 本番環境のブランチ。**`push` されると本番環境（wp/wp-content/plugins/my-snow-monkey/）へ自動デプロイされる**

## SASS コンパイルについて

VSCode の Live Sass Compiler（DartSass が使える Glenn Marks さんの方）のアドオンでコンパイルしている

## My Snow Monkey について

子テーマの `functions.php` にカスタマイズコードを追加するように、このプラグインの `my-snow-monkey.php` に書くと、同じようにカスタマイズが反映されます。

### 定数

下記の定数が利用可能です。

#### MY_SNOW_MONKEY_URL

My Snow Monkey プラグインディレクトリへの URL

#### MY_SNOW_MONKEY_PATH

My Snow Monkey プラグインディレクトリへの ファイルパス
