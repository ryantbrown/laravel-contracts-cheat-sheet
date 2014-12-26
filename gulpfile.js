var gulp = require('gulp');
var less = require('gulp-less');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');
var minify = require('gulp-minify-css');
var prefix = require('gulp-autoprefixer');

var scripts = [
    './assets/vendor/jquery/jquery.js',
    './assets/vendor/semantic/semantic.js',
    './assets/js/script.js'
];

gulp.task('less', function () {
    gulp.src('./assets/less/style.less')
        .pipe(less())
        .pipe(gulp.dest('./assets/css'));
});

gulp.task('css', ['less'], function() {
    gulp.src('./assets/css/style.css')
        .pipe(prefix())
        .pipe(minify())
        .pipe(gulp.dest('./public/css'));
});

gulp.task('script', function() {
    gulp.src(scripts)
        .pipe(concat('script.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./public/js'));
});

gulp.task('default', function(){
    gulp.start('css');
    gulp.start('script');
});