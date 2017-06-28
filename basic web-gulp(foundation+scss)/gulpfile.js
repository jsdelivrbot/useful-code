var gulp = require('gulp');
var gulpSass = require('gulp-sass');
var gulpAutoprefixer = require('gulp-autoprefixer');
var gulpSourcemaps = require('gulp-sourcemaps');
var gulpBrowserSync = require('browser-sync');

gulp.task('browser-sync', function() {
    gulpBrowserSync.init({
        proxy: "127.0.0.1/goldenjade"
    });
});

gulp.task('sass', function() {
    gulp.src('sass/*.scss')
        .pipe(gulpSass({
            errLogToConsole: true,
            // outputStyle: 'compressed'
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
    gulp.watch('sass/*.scss', ['sass']);
    gulp.watch('./*.php', ['reload']);
});

gulp.task('default', ['browser-sync', 'watch']);