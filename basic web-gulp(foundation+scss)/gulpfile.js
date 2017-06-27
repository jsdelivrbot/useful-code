var gulp = require('gulp');
var gulpAutoprefixer = require('gulp-autoprefixer');
var gulpBrowserSync = require('browser-sync');
var gulpCompass = require('gulp-compass');
var gulpSourcemaps = require('gulp-sourcemaps');

gulp.task('browser-sync', function() {
    gulpBrowserSync.init({
        proxy: "127.0.0.1/qwe123"
    });
});

gulp.task('compass', function() {
    gulp.src('sass/*.scss')
        .pipe(gulpCompass({
            config_file: './config.rb',
            sass: 'sass',
            css: 'stylesheets'
        }))
        .pipe(gulpSourcemaps.init())
        .pipe(gulpAutoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }))
        .pipe(gulpSourcemaps.write('./'))
        .pipe(gulp.dest('stylesheets'))
        .pipe(gulpBrowserSync.stream());
});

gulp.task('reload', function() {
    gulpBrowserSync.reload();
});

gulp.task('watch', function() {
    gulp.watch('sass/*.scss', ['compass']);
    gulp.watch('./*.php', ['reload']);
});

gulp.task('default', ['browser-sync', 'watch']);