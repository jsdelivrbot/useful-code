var gulp = require('gulp');
var gulpSass = require('gulp-sass');
var gulpJade = require('gulp-jade-php');

gulp.task('sass', function() {
	gulp.src('sass/*.sass')
		.pipe(gulpSass())
		.pipe(gulp.dest('stylesheets'));
});

gulp.task('jade', function() {
  gulp.src('jade/*.jade')
    .pipe(gulpJade({
    	//
    }))
     .pipe(gulp.dest('./'));
});

gulp.task('watch', function () {
    gulp.watch('sass/*.sass', ['sass']);
    gulp.watch('jade/*.jade', ['jade']);
});