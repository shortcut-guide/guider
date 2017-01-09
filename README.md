# Guider
Wordpressのテーマ販売用を促進するためのローカル開発環境とWordpressテーマ。

[version] 1.0.0  
[著者] Shortcut  
[URL] https://github.com/shortcut-guide/guider  

# Guider
Wordpressのテーマ販売用を促進するためのローカル開発環境とWordpressテーマ。

[更新日] 2017.01.09
[著者] Shortcut
[URL] https://github.com/shortcut-guide/guider

## 目次

* VCCW設定
* gulp設定

---

### VCCW設定

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

### gulp設定
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

### 起動

[1] `vagrant up`
vagrantを起動する場合には、コマンドからvagrantを実行してください。

[2] `gulp`
gulpを起動。コマンドからgulpを実行してください。

下記にアクセス
http://guider.dev