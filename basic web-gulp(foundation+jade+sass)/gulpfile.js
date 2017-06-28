var gulp = require('gulp');
var gulpSass = require('gulp-sass');
var gulpJade = require('gulp-jade-php');
var gulpSourcemaps = require('gulp-sourcemaps');
var gulpAutoprefixer = require('gulp-autoprefixer');
var gulpBrowserSync = require('browser-sync');

gulp.task('browser-sync', function() {
    gulpBrowserSync.init({
        proxy: "127.0.0.1/qwe123"
    });
});

gulp.task('sass', function() {
    gulp.src('sass/*.sass')
        .pipe(gulpSass({
            errLogToConsole: true,
            outputStyle: 'compressed'
        }))
        .pipe(gulpSourcemaps.init())
        .pipe(gulpAutoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }))
        .pipe(gulpSourcemaps.write())
        .pipe(gulp.dest('stylesheets'))
        .pipe(gulpBrowserSync.stream());
});

gulp.task('jade', function() {
    gulp.src('jade/*.jade')
        .pipe(gulpJade({
            // pretty: true
        }))
        .pipe(gulp.dest('./'));
});

gulp.task('jade-rebuild', ['jade'], function() {
    gulpBrowserSync.reload();
});

gulp.task('watch', function() {
    gulp.watch('sass/*.sass', ['sass']);
    gulp.watch('jade/*.jade', ['jade-rebuild']);
});

gulp.task('default', ['browser-sync', 'watch']);