// Libraries
var fs = require('fs');
var gulp = require('gulp');
var gutil = require('gulp-util');
var notify = require('gulp-notify');
var sass = require('gulp-ruby-sass');
var jshint = require("gulp-jshint");
var concat = require("gulp-concat");
var uglify = require("gulp-uglify");
var rename = require("gulp-rename");
var gzip = require("gulp-gzip");
var awspublish = require('gulp-awspublish');

// Variables
var version = '0.0.1';
var srcSassDir = './app/assets/src/sass';
var srcCssDir = './app/assets/src/css';
var srcJsDir = './app/assets/src/js';
var distDir = './app/assets/dist/' + version;
var distCssDir = './app/assets/dist/' + version + '/css';
var distJsDir = './app/assets/dist/' + version + '/js';

// Load config
var config = JSON.parse(fs.readFileSync('./gulp-config.json', 'utf8'));

// Development Sass
gulp.task('dev-sass', function() {
    return gulp.src(srcSassDir + '/main.scss')
        .pipe(sass().on('error', gutil.log))
        .pipe(rename('main.css'))
        .pipe(gulp.dest(srcCssDir))
        .pipe(notify('Sass compiled'));
});

// Development Javascript
// TODO

// Build Sass and CSS
gulp.task('build-sass', function() {
    return gulp.src(srcSassDir + '/main.scss')
        .pipe(sass({
            style: 'compressed'
        }).on('error', gutil.log))
        .pipe(gzip())
        .pipe(rename('master.min.css'))
        .pipe(gulp.dest(distCssDir))
        .pipe(notify('Sass compiled and compressed for distribution'));
});

// Build: Concatenate & Minify JS
gulp.task('build-js', function() {
    gulp.src([srcJsDir + '/plugins.min.js'])
        .pipe(gulp.dest(distJsDir));

    return gulp.src([srcJsDir + '/*.js', '!' + srcJsDir + '/plugins.min.js'])
        .pipe(jshint())
        .pipe(jshint.reporter("default"))
        .pipe(concat('master.min.js'))
        .pipe(uglify())
        .pipe(gzip())
        .pipe(rename('master.min.js'))
        .pipe(gulp.dest(distJsDir))
        .pipe(notify('JS compiled and compressed for distribution'));
});

// Publish assets to S3
gulp.task('publish', function() {

    var publisher = awspublish.create({
        key: config.awsKey,
        secret: config.awsSecret,
        bucket: config.awsBucket
    });

    var headers = {
        'Content-Encoding': 'gzip'
    };

    return gulp.src(distDir + '/css/*')
        .pipe(publisher.publish(headers))
        .pipe(awspublish.reporter())
        .pipe(notify('Pushed to AWS'));
});

// Build tasks
gulp.task('build', ['build-sass', 'build-js']);

// Watch tasks
gulp.task('watch', function() {
    gulp.watch(srcSassDir + '/**/*.scss', ['dev-sass']);
});

// Default task
gulp.task('default', ['watch']);