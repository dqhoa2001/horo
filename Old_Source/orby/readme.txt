=== Orby ===
Requires at least: 3.5
Tested up to: 4.5
Stable tag: 0.9
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Author : KAIBE Takahiro 

This plugin displays the RSS list from some sites on a page or a post or a widget.

== Description ==

ホロスコープを出力するプラグインです。

投稿やページ中にショートコード"orby_chart_form"を挿入することでフォームを出力します。

ホロスコープ用の固定ページを用意し、ページ本文に [orby_chart_form] を入れて保存してください。

依存関係ですが、ImageMagick が必要です。

また、天体の位置計算用にSwissEphemeris という外部プログラムを同梱しています。プラグイン直下の "swetest" というファイルがその実行ファイルです。

プラグインを有効化するタイミングでパーミッションを755にしますが、環境によっては失敗する可能性があります。その場合は、手動で同ファイルの実行権限をつけてください。




== Installation ==

1. Upload `plugin-name.zip` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress




