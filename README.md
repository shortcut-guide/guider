# Guiter
Wordpressのテーマ販売用を促進するためのローカル開発環境とWordpressテーマ。

[更新日] 2017.01.09
[著者] Shortcut
[URL] https://github.com/shortcut-guide/guider

## 目次
1. 設定の前に
2. VCCWの環境を簡単に設定する
3. VCCW設定
4. gulp設定
5. vccw/gulp 起動
6. Wordpressの初期設定
7. デモデータのインポート

---
### 1.設定の前に

#### WP-CLI
WordPressをコマンドから管理出来るツールにWP-CLIがあります。
WP-CLIを使うことによって、プラグインのインストールや、ユーザの設定、パーマリンクの設定等が出来ます。雛形のWordPressを作成したいときによく使用します。

##### インストール方法
wp-cli.phar ファイルをダウンロードします
`curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar`

##### 実行権限を付け、PATHに通します
`chmod +x wp-cli.phar`
`sudo mv wp-cli.phar /usr/local/bin/wp`

`wp cli version`

---
### 2.VCCWの環境を簡単に設定する

#### インストール
[GitHub - vccw-team/scaffold-vccw: WP-CLI command that generates a new VCCW.](https://github.com/vccw-team/scaffold-vccw)

#### VCCWの設定
`wp scaffold vccw <ディレクトリ名>`

[sample]
`wp scaffold vccw wordpress.dev --lang=ja`

---

### 3.VCCW設定

#### default.yml
重要な箇所だけ一部抜粋して記載してます。

##### Network Settings
* hostname: guider.dev
* ip: 192.168.33.10

##### WordPress User
* admin_user: admin
* admin_pass: admin
* admin_email: vccw@example.com

##### WordPress Database
* db_prefix: wp_
* db_host: localhost
* db_name: guider
* db_user: guider
* db_pass: guider

##### WordPress Default Theme
* theme: 'guider'

---

### 4.gulp設定
browsersyncの設定でWordPressのローカル環境をブラウザ同期します。

```
//gulp+browsersyncの読み込み
var gulp = require('gulp');
var browserSync = require("browser-sync").create();
var reload = browserSync.reload;

// browsersyncの設定
gulp.task("BrowserSyncOn", function () {

    // VCCWのIPを設定
    browserSync.init({
        proxy: "guider.dev"
    });
    gulp.watch("./**/*").on("change", reload);
});
gulp.task('default', ['BrowserSyncOn']);
```

VCCWとgulpとBrowsersyncを組み合わせると、プロジェクトディレクトリ内のファイルが更新されるとブラウザが自動でリロードされます。

---

### 5.vccw/gulp 起動

[1] `vagrant up`
vagrantを起動する場合には、コマンドからvagrantを実行してください。

[2] `gulp`
gulpを起動。コマンドからgulpを実行してください。

下記にアクセス
http://localhost:3000/

初期wordpress管理画面
http://localhost:3000/wp-admin
user: admin
pass: admin

---

### 6.Wordpressの初期設定

[1] プラグインの有効化
予め、テーマ作成に必要とするプラグインは導入済みです。
必要となるプラグインを有効化してください。

＊プラグイン「*WP BASIC Auth*」は必要に応じて設定してください。
[WP BASIC Auth — WordPress Plugins](https://ja.wordpress.org/plugins/wp-basic-auth/)

[2] プラグイン「*SiteGuard WP Plugin*」でログインの設定
[SiteGuard WP Plugin — WordPress Plugins](https://ja.wordpress.org/plugins/siteguard/)

ログインURLを変える事によって、セキュリティをアップする。

[image:49ECA129-461E-4DAA-866E-07DFD2B01320-1820-00000EAA03D209A8/Untitled.png]

#### Google Authenticatorのインストール
プラグインを有効にすると再ログインが必要となります。
その際、下記のアプリが必要となります。ワンタイムパスワードが発行され、ログイン時にワンタイムパスワードが必要となります。

スマホアプリ「*Google Authenticator*」
[Google Authenticatorを App Store で](https://itunes.apple.com/jp/app/google-authenticator/id388497605?mt=8)
[Google 認証システム - Google Play の Android アプリ](https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=ja)

---

### 7. デモデータのインポート
プラグイン「*All-inOne WP Migration*」からデモデータをインポート
[All in One WP Migrationプラグイン| ServMask Inc.](https://servmask.com/)

デモデータのファイル
/wordpress/wp-content/ai1wm-backups/demo-data.wpress

1. Wordpress管理画面のサイドバー「*All-inOne WP Migration*」> Importを選択
2. IMPORT FROMからデモデータのファイルをIMPORT


