var gulp = require('gulp');
var gulpCompass = require('gulp-compass');
var gulpAutoprefixer = require('gulp-autoprefixer');
var gulpSourcemaps = require('gulp-sourcemaps');
var gulpBrowserSync = require('browser-sync');
var gulpCopy = require('gulp-copy');

gulp.task('browser-sync', function() {
    gulpBrowserSync.init({
        proxy: "127.0.0.1/qwe123"
    });

    gulp.watch('sass/*.scss', ['sass']);

    gulpBrowserSync.watch('./*.php').on('change', gulpBrowserSync.reload);

    gulpBrowserSync.watch('js/*.js').on('change', gulpBrowserSync.reload);
});

gulp.task('sass', function() {
    gulp.src('sass/*.scss')
        .pipe(gulpCompass({
            config_file: './config.rb',
            sass: 'sass',
            css: 'stylesheets'
        }))
        .pipe(gulpSourcemaps.init())
        .pipe(gulpAutoprefixer({
            browsers: ['last 2 versions', 'ie >= 9', 'and_chr >= 2.3'],
            cascade: false
        }))
        .pipe(gulpSourcemaps.write('./'))
        .pipe(gulp.dest('stylesheets'))
        .pipe(gulpBrowserSync.stream());
});

gulp.task('output', function() {
    gulp.src([
            'css/*',
            'images/*',
            'js/*',
            'stylesheets/*.css',
            '*.php',
        ])
        .pipe(gulpCopy('./public/'));
});

gulp.task('default', ['sass', 'browser-sync']);