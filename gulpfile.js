var gulp = require('gulp'),
settings = require('./settings'),
webpack = require('webpack'),
browserSync = require('browser-sync').create(),
autoprefixer = require('gulp-autoprefixer'),
sass = require('gulp-sass'),
cssnano = require('gulp-cssnano'),
wait = require('gulp-wait');

// task styles
gulp.task('styles', function () {

  return gulp.src('sass/style.scss')
    .pipe(wait(500)) // unexpected behavior without this delay
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer())
    .pipe(cssnano({
      zindex: false // otherwise z-index is with wrong value
    }))
    .pipe(gulp.dest(''))

});

// task scripts
gulp.task('scripts', function(callback) {

  webpack(require('./webpack.config.js'), function(err, stats) {
    if (err) {
      console.log(err.toString());
    }

    console.log(stats.toString());
    callback();
  });

});

// task watch
gulp.task('watch', function() {

  browserSync.init({
    notify: false,
    proxy: settings.urlToPreview,
    ghostMode: false
  });

  gulp.watch(settings.themeLocation + '**/*.php', function () {
    browserSync.reload();
  });

  gulp.watch(settings.themeLocation + 'sass/**/*.scss', ['waitForStyles']);

  gulp.watch([settings.themeLocation + 'js/modules/*.js'], ['waitForScripts']);
});


// task waitForStyles
gulp.task('waitForStyles', ['styles'], function() {

  return gulp.src(settings.themeLocation + 'style.css')
    .pipe(browserSync.stream());

});

// task waitForScripts
gulp.task('waitForScripts', ['scripts'], function() {
  
  browserSync.reload();

});