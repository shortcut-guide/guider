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
