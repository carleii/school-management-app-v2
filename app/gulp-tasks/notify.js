var notify = require("gulp-notify");

module.exports = (gulp, callback) => {
  const notifyCssTask = function (done) {
    notify("CSS Build Complete!!", done);
  }
  const notifyHtmlTask = function (done) {
    notify("HTML Build Complete!!", done);
  }
  const notifyJsTask = function (done) {
    notify("JS Build Complete!!", done);
  }

  // ---------------------------------------------------------------------------
  // Exports

  return {
    css: notifyCssTask,
    html: notifyHtmlTask,
    js: notifyJsTask
  }
}
