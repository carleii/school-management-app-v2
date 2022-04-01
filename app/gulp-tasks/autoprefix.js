var autoprefixer = require('gulp-autoprefixer');

module.exports = (gulp, callback) => {
  const autoprefixCssTask = function () {
    return gulp.src(['**/*.css', '!**/*.min.css'], { cwd: config.destination.css })
    .pipe(autoprefixer({
        cascade: false
    }))
    .pipe(gulp.dest(config.destination.css));
  }

  const autoprefixCssRtlTask = function () {
    return gulp.src(['**/*.css', '!**/*.min.css'], { cwd: config.destination.css_rtl })
    .pipe(autoprefixer({
        cascade: false
    }))
    .pipe(gulp.dest(config.destination.css_rtl));
  }

  // ---------------------------------------------------------------------------
  // Exports

  return {
    css: autoprefixCssTask,
    css_rtl: autoprefixCssRtlTask,
  }
}
