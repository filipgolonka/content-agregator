var gulp = require('gulp');
var gulpBowerFiles = require('gulp-bower-files');

gulp.task("bower-files", function () {
    gulpBowerFiles().pipe(gulp.dest("./public"));
});

gulp.task('default', ['bower-files']);