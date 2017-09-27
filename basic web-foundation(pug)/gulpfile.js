var gulp = require('gulp');
var gulpPug = require('gulp-pug');
var gulpCompass = require('gulp-compass');
var gulpAutoprefixer = require('gulp-autoprefixer');
var gulpSourcemaps = require('gulp-sourcemaps');
var gulpBrowserSync = require('browser-sync');

gulp.task('browser-sync', function() {
    gulpBrowserSync.init({
        proxy: "127.0.0.1/qwe123"
    });

    gulpBrowserSync.watch('js/*.js').on('change', gulpBrowserSync.reload);
});

// gulp.task('sass', function() {
//     gulp.src('sass/*.scss')
//         .pipe(gulpCompass({
//             config_file: './config.rb',
//             sass: 'sass',
//             css: 'stylesheets'
//         }))
//         .pipe(gulpSourcemaps.init())
//         .pipe(gulpAutoprefixer({
//             browsers: ['last 2 versions', 'ie >= 9', 'and_chr >= 2.3'],
//             cascade: false
//         }))
//         .pipe(gulpSourcemaps.write('./'))
//         .pipe(gulp.dest('stylesheets'))
//         .pipe(gulpBrowserSync.stream());
// });

gulp.task('sass', function() {
    return gulp.src('sass/*.scss')
        .pipe(gulpSourcemaps.init())
        .pipe(gulpSass({
            includePaths: ['node_modules/foundation-sites/scss'],
            outputStyle: 'compressed'
        }).on('error', gulpSass.logError))
        .pipe(gulpAutoprefixer({
            browsers: ['last 2 versions', 'ie >= 9', 'and_chr >= 2.3'],
            cascade: false
        }))
        .pipe(gulpSourcemaps.write('./'))
        .pipe(gulp.dest('stylesheets'))
        .pipe(gulpBrowserSync.stream());
});

gulp.task('pug', function buildHTML() {
    return gulp.src('pug/*.pug')
        .pipe(gulpPug({
            // Your options in here.
        }))
        .pipe(gulp.dest('./'))
});

gulp.task('pug-rebuild', ['pug'], function() {
    gulpBrowserSync.reload();
});

gulp.task('watch', function() {
    gulp.watch('sass/*.scss', ['sass']);
    gulp.watch('pug/*.pug', ['pug-rebuild']);
});

gulp.task('default', ['browser-sync', 'watch']);