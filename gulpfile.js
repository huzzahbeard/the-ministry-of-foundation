

////////////////////////////////
/* NPM Modules for GULP tools */
////////////////////////////////
var gulp = require('gulp');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var minifyCSS = require('gulp-minify-css');
var sass = require('gulp-sass');
var livereload = require('gulp-livereload');
var imagemin = require('gulp-imagemin');
var watch = require('gulp-watch');

////////////////////////////////
/* Path Settings              */
////////////////////////////////
var watch = {
    scripts:['assets/working/js/**/*.js'],
    styles:['assets/working/scss/styles/**/*.scss',
            'assets/working/scss/styles/styles.scss',
            'assets/bower_components/foundation/scss/foundation/_settings.scss']
};

// Javascript


var scriptpaths = {
    libs: [
        'bower_components/foundation/js/vendor/jquery.js',
        'bower_components/foundation/js/vendor/fastclick.js',
        'bower_components/foundation/js/foundation.min.js'
    ],
    custom: [
        'assets/working/js/*.js'
    ]
};
// Built custom and vendor files
scriptpaths.builtScripts = 'assets/build/js/custom.min.js';
scriptpaths.builtLibs = 'assets/build/js/libs.min.js';

// Stylesheets
var stylepath = 'assets/working/scss/styles/styles.scss';
// Built custom and vendor files
//stylepaths.builtStyles = 'assets/build/css/custom.min.css';
//stylepaths.builtLibs = 'assets/build/css/libs.min.css';

////////////////////////////////////
/* End Javascript bundle settings */
////////////////////////////////////
// Task definitions
// Minify and copy all non vendor js
gulp.task('customScripts', function() {
    return gulp.src(scriptpaths.custom)
        .pipe(uglify({mangle: false}))
        .pipe(concat('custom.min.js'))
        .pipe(gulp.dest('assets/build/js'));
});
// copy all vendor js to one file
gulp.task('libsScripts', ['customScripts'], function() {
    return gulp.src(scriptpaths.libs)
        .pipe(uglify({mangle: false}))
        .pipe(concat('libs.min.js'))
        .pipe(gulp.dest('assets/build/js'));
});
// combine local js with vendor js for a single request
gulp.task('combineScripts', ['libsScripts'], function() {
    return gulp.src([scriptpaths.builtLibs, scriptpaths.builtScripts])
        .pipe(concat('all.min.js'))
        .pipe(gulp.dest('assets/build/js'));
});
/////////////////////////
/* CSS bundle settings */
/////////////////////////

// Task definitions

// convert/Minify and concat all sass into CSS Follows Import paths using the SYM link for bower
//{includePaths : ['assets/build/scss/'], errLogToConsole: true}
gulp.task('styles', function() {
    return gulp.src(stylepath)
        .pipe(sass({includePaths : ['assets/build/scss/']}))
        .pipe(minifyCSS())
        .pipe(concat('all.min.css'))
        .pipe(gulp.dest('assets/build/css'));
});
/////////////////////////////
/* End CSS bundle settings */
/////////////////////////////

// watch non vendor scripts/styles for changes and add them to the bundle
gulp.task('watch', function() {
    gulp.watch(watch.scripts, ['combineScripts']);
    gulp.watch(watch.styles, ['styles']);
    // gulp.watch(['*.html', 'templates/*.html']).on('change', function(file) {
    //     livereload().changed(file.path);
    // });
});

// //imagemin
// gulp.task('imagemin', function(){
//     // optimize your images
//     gulp.src('assets/working/images/*')
//         .pipe(imagemin())
//         .pipe(gulp.dest('assets/build/images/'));
// });

///////////////////////////
/* Construct Build Tasks */
///////////////////////////

// The default development running task
gulp.task('default', ['combineScripts', 'styles', 'watch']);

///////////////////////////////
/* End Construct Build Tasks */
///////////////////////////////
