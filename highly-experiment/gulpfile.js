var gulp = require('gulp');
var pug = require('gulp-pug');
var sass = require('gulp-sass');
var compass = require('gulp-compass');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
var browserSync = require('browser-sync');
var changed = require('gulp-changed');
var svgSprite = require('gulp-svg-sprite');
var babel = require("gulp-babel");
var browserify = require("gulp-browserify");
var webpack = require('webpack-stream');

gulp.task('browser-sync', function() {
    browserSync.init({
        // reloadDelay: 500,
        proxy: "127.0.0.1/qwe123"
    });

    gulp.watch('sass/*.scss', ['sass']);

    gulp.watch('js/*.js', ['babel']);

    gulp.watch('svg/*.svg', ['svg-rebuild']);

    // gulp.watch(['vue/components/*.vue', 'vue/*.js'], ['vue']);

    // gulp.watch('pug/*.pug', ['pug-rebuild']);

    browserSync.watch(['*.html', '*.php']).on('change', browserSync.reload);
});

// FIXME: 待修改
// gulp.task('react', function() {
//     return gulp.src('components/*.jsx', {
//             read: false
//         })
//         .pipe(tap(function(file) {
//             file.contents = new_browserify(file.path, {
//                 debug: true
//             })
//             .transform('babelify', {
//                 presets: ['es2015', 'react']
//             })
//             // .plugin('css-modulesify')
//             .bundle()
//         }))
//         .pipe(buffer())
//         .pipe(ext.replace('js'))
//         .pipe(gulp.dest('dist'))
//         .pipe(browserSync.stream());
// });

gulp.task('vue', function() {
    return gulp.src('vue/*.js')
        .pipe(webpack(require('./webpack.config.js') ))
        .pipe(gulp.dest('dist'))
        .pipe(browserSync.stream());
});

gulp.task('babel', function() {
    return gulp.src('js/*.js')
        .pipe(babel({
            presets: ['es2015', 'stage-3'],
        }))
        .pipe(browserify())
        .pipe(gulp.dest('dist'))
        .pipe(browserSync.stream());
});

gulp.task('pug', function buildHTML() {
    return gulp.src('pug/*.pug')
        .pipe(pug({
            // pretty: true
        }))
        .pipe(gulp.dest('./'))
});

gulp.task('pug-rebuild', ['pug'], browserSync.reload);

// gulp.task('sass', function() {
//     gulp.src('sass/*.scss')
//         .pipe(compass({
//             config_file: './config.rb',
//             sass: 'sass',
//             css: 'stylesheets'
//         }))
//         .pipe(sourcemaps.init())
//         .pipe(autoprefixer({
//             browsers: ['last 2 versions', 'ie >= 9', 'and_chr >= 2.3'],
//             cascade: false
//         }))
//         .pipe(sourcemaps.write('./'))
//         .pipe(gulp.dest('stylesheets'))
//         .pipe(browserSync.stream());
// });

gulp.task('sass', function() {
    return gulp.src('sass/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass({
        includePaths: ['node_modules/foundation-sites/scss'],
        outputStyle: 'compressed'
    }).on('error', sass.logError))
    .pipe(autoprefixer({
        browsers: [
            'last 2 versions', 'ie >= 9', 'and_chr >= 2.3'
        ],
        cascade: false
    }))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('stylesheets'))
    .pipe(browserSync.stream());
});

// FIXME: 待修改pug react vue等等
// gulp.task('copy', function() {
//     gulp.src([
//         'css/**',
//         'fonts/**',
//         'images/**',
//         'js/**',
//         'mobile/**',
//         'stylesheets/*.css',
//         '*.php'
//     ], {
//         base: './'
//     })
//     .pipe(changed('public'))
//     .pipe(gulp.dest('public'));
// });

gulp.task('svg', function() {
    return gulp.src('svg/*.svg').pipe(svgSprite({
        mode: {
            defs: {
                dest: './',
                sprite: "images/all.defs.svg",
                render: {
                    css: {
                        dest: 'stylesheets/svg-sprites-dims.css'
                    }
                },
                inline: true,
                example: false
            }
        }
    }))
    .pipe(gulp.dest("./"));
});

gulp.task('svg-rebuild', ['svg'], browserSync.reload);

// normal
gulp.task('default', ['svg', 'sass', 'babel', 'browser-sync']);

// vue
// gulp.task('default', ['svg', 'sass', 'babel', 'vue', 'pug', 'browser-sync']);

// react
// gulp.task('default', ['svg', 'sass', 'babel', 'react', 'pug', 'browser-sync']);
