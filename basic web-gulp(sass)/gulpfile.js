// Modules & Plugins
var gulp = require('gulp');
var connect = require('gulp-connect-php');
var sourcemaps = require('gulp-sourcemaps');
var browserSync = require('browser-sync');
var gulpCompass = require('gulp-compass');

// Error Helper
function onError(err) {
    console.log(err);
}

// browserSync Task
gulp.task('browser-sync', function() {
    browserSync({
        proxy: '127.0.0.1:8080',
        port: 8080,
        open: true,
        notify: false
    });
});

// Server Task
gulp.task('server', function() {
    connect.server({
        port: 8080,
        keepalive: true,
    });
});

// sass compline
gulp.task('styles', function() {
    gulp.src('sass/*.scss')
        .pipe(gulpCompass({
            config_file: './config.rb',
            css: 'stylesheets',
            sass: 'sass'
        }));
});

// Watch Task
gulp.task('watch', function() {
    gulp.watch('sass/*.scss', ['styles']);

    gulp.watch('*').on('change', function () {
        browserSync.reload();
    });
});

// Default Task
gulp.task('default', ['browser-sync', 'server', 'watch', 'styles']);