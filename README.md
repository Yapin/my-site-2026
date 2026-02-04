# 2026 年版自社サイト

テーマは「SNOW MONKEY」、カスタマイズは「My Snow Monkey」で行います。

## 環境構築

### ローカル開発（SCSS コンパイル）

リポジトリ直下で以下を実行します。

```bash
npm install
```

SCSS のウォッチ（開発用ソースマップあり）:

```bash
npm run dev
```

本番用ビルド（圧縮・ソースマップなし）:

```bash
npm run build
```

入力: `assets/scss/`  
出力: `assets/css/`（生成された CSS は Git 管理外）

## ブランチ

- `main` 安定して動作する、開発の中心となるブランチ。
- 今回のセットアップでは、`main` への push をトリガーに GitHub Actions で `my-snow-monkey` プラグインを自動デプロイする。

## SASS コンパイルについて

現在は npm scripts + Dart Sass でコンパイルします（VSCode の Live Sass Compiler は任意）。

- 開発時: `npm run dev`
- 本番ビルド: `npm run build`

エントリーポイント: `assets/scss/style.scss`

## GitHub Actions による自動デプロイ（FTP）

### ワークフロー概要

- ファイル: `.github/workflows/deploy.yml`
- トリガー: `main` ブランチへの push
- 処理の流れ:
  1. リポジトリを checkout（このリポジトリ直下がそのまま `my-snow-monkey` プラグインルート）
  2. Node.js LTS をセットアップ
  3. `npm ci` で依存関係をインストール
  4. `npm run build` で SCSS をビルド
  5. リポジトリ直下のファイル群を **FTP** でサーバー側の `wp-content/plugins/my-snow-monkey/` へ同期

### GitHub Secrets の設定（FTP）

リポジトリの **Settings → Secrets and variables → Actions → New repository secret** から、以下を追加します。

- `FTP_SERVER`: FTP サーバーのホスト名または IP（例: `ftp.example.com`）
- `FTP_PORT`: FTP ポート番号（通常は `21`。FTPS など別ポートの場合はその値）
- `FTP_USERNAME`: FTP ログインユーザー名
- `FTP_PASSWORD`: FTP ログインパスワード
- `FTP_PROTOCOL`: 接続プロトコル
  - `ftp`（暗号化なし） / `ftps`（推奨: 明示的 FTPS） / `ftps-legacy`（暗号化あり・レガシー）
- `REMOTE_PATH`:
  - サーバー側の `wp-content/plugins/my-snow-monkey/` ディレクトリのフルパス
  - 例: `/home/USER/public_html/wp-content/plugins/my-snow-monkey/`

### よくあるエラーと対処

- **No such file or directory（REMOTE_PATH 間違い）**:
  - `REMOTE_PATH` の末尾まで正しいか確認（`.../wp-content/plugins/my-snow-monkey/` になっているか）
  - ディレクトリが存在しない場合は、サーバー側で事前にディレクトリを作成しておく
- **FTP 接続エラー（タイムアウト / 接続拒否 / ログイン失敗）**:
  - FTP サーバー名・ポート・ユーザー名・パスワードが正しいか確認
  - 必要に応じて FTPS を利用する場合は、`FTP_PROTOCOL` に `ftps` を指定
  - ファイアウォールや接続元 IP 制限がある場合は、GitHub Actions の IP 範囲を許可する必要があることに注意

## My Snow Monkey について

子テーマの `functions.php` にカスタマイズコードを追加するように、このプラグインの `my-snow-monkey.php` に書くと、同じようにカスタマイズが反映されます。

### 定数

下記の定数が利用可能です。

#### MY_SNOW_MONKEY_URL

My Snow Monkey プラグインディレクトリへの URL

#### MY_SNOW_MONKEY_PATH

My Snow Monkey プラグインディレクトリへの ファイルパス
