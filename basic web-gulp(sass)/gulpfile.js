var gulp = require('gulp');
var gulpSass = require('gulp-sass');
var gulpJade = require('gulp-jade-php');
var gulpSourcemaps = require('gulp-sourcemaps');
var gulpAutoprefixer = require('gulp-autoprefixer');

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
        .pipe(gulp.dest('stylesheets'));
});

gulp.task('jade', function() {
    gulp.src('jade/*.jade')
        .pipe(gulpJade({
            // pretty: true
        }))
        .pipe(gulp.dest('./'));
});

gulp.task('watch', function() {
    gulp.watch('sass/*.sass', ['sass']);
    gulp.watch('jade/*.jade', ['jade']);
});