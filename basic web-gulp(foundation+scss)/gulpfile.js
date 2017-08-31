var gulp = require('gulp');
var gulpCompass = require('gulp-compass');
var gulpAutoprefixer = require('gulp-autoprefixer');
var gulpSourcemaps = require('gulp-sourcemaps');
var gulpBrowserSync = require('browser-sync');

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
    gulp.src(['css/*'])
        .pipe(gulp.dest('public/css'));

    gulp.src(['images/*'])
        .pipe(gulp.dest('public/images'));

    gulp.src(['js/*'])
        .pipe(gulp.dest('public/js'));

    gulp.src(['stylesheets/*.css'])
        .pipe(gulp.dest('public/stylesheets'));

    gulp.src(['*.php'])
        .pipe(gulp.dest('public'));
});

gulp.task('default', ['sass', 'browser-sync']);