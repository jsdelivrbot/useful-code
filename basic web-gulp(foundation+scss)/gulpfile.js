var gulp = require('gulp');
var gulpCompass = require('gulp-compass');
var gulpAutoprefixer = require('gulp-autoprefixer');
var gulpSourcemaps = require('gulp-sourcemaps');
var gulpBrowserSync = require('browser-sync');
var gulpChanged = require('gulp-changed');
var gulpSvgSprites = require('gulp-svg-sprites');

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

gulp.task('copy', function () {
    gulp.src([
            'css/**',
            'images/**',
            'js/**',
            'mobile/**',
            'stylesheets/*.css',
            '*.php',
        ], { base: './' })
        .pipe(gulpChanged('public'))
        .pipe(gulp.dest('public'));
});

gulp.task('svg', function () {
    return gulp.src('images/svg/*.svg')
        .pipe(gulpSvgSprites({
            cssFile: "stylesheets/sprites.css",
            svg: {
                sprite: "images/sprites.symbol.svg"
            },
            selector: "svg-%f",
            preview: false
        }))
        .pipe(gulp.dest("./"));
});

gulp.task('svg-rebuild', ['svg'], function() {
    gulpBrowserSync.reload();
});

gulp.task('watch', function() {
    gulp.watch('images/svg/*.svg', ['svg-rebuild']);
});

gulp.task('default', ['watch', 'sass', 'browser-sync']);