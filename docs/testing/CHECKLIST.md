# Testing Checklist

- [ ] PHPUnit 実行互換性: `phpunit.xml` と PHPUnit v10 の整合性（testsuites/coverage/logging）。
- [ ] カバレッジ拡大: `includes/runtime/*` 全体（Viewer/JavaScript/Theme/LanguageHandler を含む）。
- [ ] ヘルパ関数: `modules/Vtiger/helpers/*` のDB非依存関数を優先カバー。
- [ ] リクエスト/レスポンス: `includes/http/{Request,Response}` の最小実行環境（CSRF/Referer のスタブ化）で通過テスト。
- [ ] 言語処理: `Vtiger_Language_Handler` を、最小のテスト用言語ファイルで検証。
- [ ] Smarty 依存: `Vtiger_Viewer` のテンプレート解決テストでコンパイル出力先を `test/templates_c` に固定し汚染防止。
- [ ] キャッシュ: `Vtiger_Cache::flush*` 系の副作用確認とリーク防止（前後で初期化）。
- [ ] カバレッジ計測: Xdebug 有効化と `--coverage-html tests/reports/coverage` の生成・共有。
- [ ] Composer スクリプト: `composer test` エイリアスの追加（任意）。
- [ ] CI 連携: GitHub Actions で `vendor/bin/phpunit` 実行（Docker か PHP セットアップを選択）。
- [ ] ドキュメント: `AGENTS.md` へのテスト実行手順/カバレッジ出力の追記（必要なら）。
