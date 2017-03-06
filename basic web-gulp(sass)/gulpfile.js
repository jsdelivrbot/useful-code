// Modules & Plugins
var gulp = require('gulp');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var jshint = require('gulp-jshint');
var imagemin = require('gulp-imagemin');
var connect = require('gulp-connect-php');
var clean = require('gulp-clean');
var sourcemaps = require('gulp-sourcemaps');
var browserSync = require('browser-sync');
var gulpCompass = require('gulp-compass');
var cleanCss = require('gulp-clean-css');
var autoprefixer = require('gulp-autoprefixer');
var rename = require('gulp-rename');
var cache = require('gulp-cache');

// Error Helper
function onError(err) {
    console.log(err);
}

// Server Task
gulp.task('server', function() {
    connect.server({
        base: 'server',
        port: 8080,
        keepalive: true,
    });
});

// browserSync Task
gulp.task('browser-sync', function() {
    browserSync({
        proxy: '127.0.0.1:8080',
        port: 8080,
        open: true,
        notify: false
    });
});

// Styles Task
gulp.task('styles', function() {
    gulp.src('sass/*.scss')
        .pipe(gulpCompass({
            config_file: './config.rb',
            css: 'stylesheets',
            sass: 'sass'
        }))
        .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 7', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
        .pipe(cleanCss())
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest('server/stylesheets'));
});

gulp.task('css', function() {
    return gulp.src('css/*.css')
        .pipe(sourcemaps.init())
        .pipe(concat('all.min.css'))
        .pipe(cleanCss())
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('server/css'))
});

// Php Task
gulp.task('php', function() {
    return gulp.src('*.php')
        .pipe(gulp.dest('server'))
});

// Scripts Task
gulp.task('scripts', function() {
    return gulp.src('js/*.js')
        .pipe(sourcemaps.init())
        .pipe(jshint())
        .pipe(concat('all.min.js'))
        .pipe(jshint.reporter('default'))
        .pipe(uglify())
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('server/js'))
});

// Images Task
gulp.task('images', function() {
    return gulp.src('images/**')
        .pipe(cache(imagemin({
            progressive: true,
            svgoPlugins: [{removeViewBox: false}]
        })))
        .pipe(gulp.dest('server/images'))
});

// Clean Task
gulp.task('clean', function() {
    return gulp.src(['server/stylesheets/*', 'server/css/*', 'server/js/*', 'server/images/*'], {
            read: false
        })
        .pipe(clean());
});

// Watch Task
gulp.task('watch', function() {
    gulp.watch('*.php', ['php']);
    gulp.watch('sass/*.scss', ['styles']);
    gulp.watch('css/*.css', ['css']);
    gulp.watch('js/*.js', ['scripts']);
    gulp.watch('images/*', ['images']);

    gulp.watch('server/**').on('change', function () {
        browserSync.reload();
    });
});

// Default Task
gulp.task('default', ['clean', 'php', 'browser-sync', 'styles', 'css', 'scripts', 'images', 'server', 'watch']);