const gulp = require('gulp');
const sass = require('gulp-sass');
const sourcemaps = require('gulp-sourcemaps');
const minify = require('gulp-minify');
const purgeSourcemaps = require('gulp-purge-sourcemaps');

const sassOptions = {
    errLogToConsole: true,
    outputStyle: 'compact'
};

function swallowError (error) {
    console.log(error.toString());

    this.emit('end')
}
gulp.task('sass', function () {
    return gulp
        .src('./src/sass/**/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass(sassOptions).on('error', sass.logError))
        .pipe(purgeSourcemaps())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('css'));
});


gulp.task('minJs', function() {
    return gulp
        .src('./src/js/*.js')
        .pipe(minify({
            ext:{
                min:'.min.js'
            },
            exclude: ['tasks'],
            ignoreFiles: ['.combo.js', '-min.js'],
            noSource: true,
        }))
        .on('error', swallowError)
        .pipe(gulp.dest('js'))
});


gulp.task('watch', function() {
    // Watch the input folder for change,
    // and run `sass` task when something happens
    gulp.watch('./src/sass/**/*.scss', gulp.series('sass'))
        .on('change', function(file) {
            console.log('File ' + file + ' was changed, running tasks...');
        });
    gulp.watch('./src/js/*.js', gulp.series('minJs'));
});
