var gulp = require('gulp');
var less = require('gulp-less');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');
var minify = require('gulp-minify-css');
var prefix = require('gulp-autoprefixer');

var scripts = [
    './assets/vendor/jquery/jquery.js',
    './assets/vendor/jquery/swipe.js',
    './assets/vendor/semantic/semantic.js',
    './assets/vendor/highlight/highlight.js',
    './assets/js/script.js'
];

gulp.task('css', function () {
    gulp.src('./assets/less/style.less')
        .pipe(less())
        .pipe(prefix())
        .pipe(minify())
        .pipe(gulp.dest('./dist/css'));
});

gulp.task('script', function() {
    gulp.src(scripts)
        .pipe(concat('script.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./dist/js'));
});

gulp.task('default', function(){
    gulp.start('css');
    gulp.start('script');
});