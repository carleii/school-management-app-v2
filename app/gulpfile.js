// Require the modules.
var gulp = require("gulp");
var minimist = require("minimist");
var config = require("./config.json");

var options = minimist(process.argv.slice(2));

// Global Variables
global.config = config;

console.log('\x1b[32m', 'Starting Gulp!!');

const autoPrefixTasks = require("./gulp-tasks/autoprefix")(gulp);
const cleanTasks = require("./gulp-tasks/clean")(gulp);
const copyTasks = require("./gulp-tasks/copy")(gulp);
const cssTasks = require("./gulp-tasks/css")(gulp);
const scssTasks = require("./gulp-tasks/scss")(gulp);
const uglifyTasks = require("./gulp-tasks/uglify")(gulp);

gulp.task("dist-clean", gulp.parallel(cleanTasks.css, cleanTasks.js));

gulp.task("monitor", gulp.parallel(scssTasks.watch));

gulp.task("dist-js", gulp.series(cleanTasks.js, copyTasks.js, uglifyTasks.js));

gulp.task(
  "sass-compile",
  gulp.parallel(scssTasks.main, scssTasks.core, scssTasks.pages, scssTasks.plugins, scssTasks.themes, scssTasks.style)
);

gulp.task("sass-compile-rtl", scssTasks.rtl);

gulp.task("dist-css", gulp.series(cleanTasks.css, "sass-compile", autoPrefixTasks.css, cssTasks.css_comb, cssTasks.css_min));

gulp.task(
  "dist-css-rtl",
  gulp.series(
    cleanTasks.css_rtl,
    "sass-compile",
    "sass-compile-rtl",
    cssTasks.css_rtl,
    autoPrefixTasks.css_rtl,
    cssTasks.css_rtl_comb,
    cssTasks.css_rtl_min
  )
);

gulp.task("dist", gulp.parallel("dist-css", "dist-js"));

gulp.task("default", gulp.parallel("dist-css", "dist-js"));
