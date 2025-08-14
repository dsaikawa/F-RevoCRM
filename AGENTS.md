# Repository Guidelines

## プロジェクト構成とモジュール
- アプリ本体: `modules/`（例: `Accounts/`, `Quotes/`）、共通: `include/`・`includes/`、エントリ: `index.php`・`webservice.php`。
- UI/資産: `layouts/`、`resources/`、`languages/`。
- 設定/データ: `config.*.php`、`storage/`、`logs/`、`cache/`。
- ツール類: `docker/`、`docker-compose.yml`、`composer.json`、`vendor/`。
- テスト: `phpunit.xml` は `tests/{Unit,Integration,Api,Database}` の `*Test.php` を対象（必要に応じて `tests/` を作成）。

## ビルド・実行・テスト
- 起動: `docker compose up -d`
- 依存関係: `docker compose exec php composer install`
- 画面確認: `http://localhost/`（初回はインストーラに従って設定）
- テスト: `docker compose exec php vendor/bin/phpunit -c phpunit.xml`
- 変更ノイズ抑制: `git update-index --assume-unchanged parent_tabdata.php tabdata.php user_privileges/user_privileges_1.php`

## コーディング規約・命名
- PHP 7.4–8.3、インデント4スペース、UTF-8、LF。
- 可能な範囲で PSR-12 準拠。レガシー修正は周辺スタイルに合わせる。
- モジュール: ディレクトリは PascalCase、クラスは StudlyCaps、メソッド/関数は camelCase。
- 翻訳は `languages/`、テンプレートは各モジュール配下および `layouts/`。

## テストガイドライン
- フレームワーク: PHPUnit。`tests/.../*Test.php` の命名で配置。
- `phpunit.xml` を利用。小さく決定的なテストを優先し、新規機能/不具合再現にカバレッジを追加。
- DB依存は Docker の `db` を使用し、最小データで隔離実行。

## コミット/PR ルール
- 課題参照: `fix #1234` / `refs #1234` を件名または本文に記載。
- PR には説明、関連Issue、再現/確認手順、UI変更はスクリーンショット、互換性/マイグレーションの注意点を含める。
- 変更は焦点を絞り、モジュール境界を尊重。無関係なリファクタは分離。

## セキュリティ/設定
- 秘密情報をコミットしない。`config.inc.php` は `config.template.php` から生成される成果物。
- ローカル差分は `.env` と `docker-compose.override.yml` を用いて管理。
- `user_privileges/` やキャッシュ等の生成物はコミット対象外に。

## 言語とエージェント指示
- このリポジトリでは作業・レビュー・PR/Issue は日本語で行います。
- Codex/エージェントは日本語での応答・出力・コミットメッセージ作成を徹底してください。
