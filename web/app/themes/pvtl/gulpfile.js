// gulp 4 version
// Defining requirements
var gulp = require('gulp');
var plumber = require('gulp-plumber');
var babel = require('gulp-babel');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var debug = require('gulp-debug');

// Configuration file to keep your code DRY
var cfg = require('./gulpconfig.json');
var paths = cfg.paths;

// Run:
// gulp scripts.
// Uglifies and concat all JS files into one
gulp.task('scripts', function(done) {

  var customScripts = [
    paths.dev + '/js/custom-javascript.js'
  ];

  var customScriptsStream = gulp.src(customScripts)
    .pipe(plumber({
      errorHandler: function (err) {
        console.log(err);
        this.emit('end');
      }
    }))
    .pipe(babel({presets: ['@babel/env']}))
    .pipe(concat('js/custom-javascript.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest(paths.dev));

  var allScripts = [

    // Start - All BS4 stuff
    paths.dev + '/js/bootstrap4/bootstrap.js',
    // End - All BS4 stuff

    paths.dev + '/js/skip-link-focus-fix.js',

    paths.node + '/swiper/swiper-bundle.min.js',

    paths.node + '/stickybits/dist/jquery.stickybits.min.js',

    paths.dev + '/js/wordpress.jquery.easy-autocomplete.min.js',

    // Adding currently empty javascript file to add on for your own themes´ customizations
    // Please add any customizations to this .js file only!
    paths.dev + '/js/custom-javascript.min.js'

  ];
  var childThemeMinJsStream = gulp.src(allScripts)
    .pipe(plumber({
      errorHandler: function (err) {
        console.log(err);
        this.emit('end');
      }
    }))
    .pipe(concat('child-theme.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest(paths.js));

  var childThemeJsStream = gulp.src(allScripts)
    .pipe(concat('child-theme.js'))
    .pipe(gulp.dest(paths.js));


  var customNonThemeScripts = [
    paths.dev + '/js/ala-fathom.js'
  ];
  
  var customNonThemeScriptsMinStream = gulp.src(customNonThemeScripts)
    .pipe(uglify())
    .pipe(debug())
    .pipe(concat('ala-fathom.min.js'))
    .pipe(gulp.dest(paths.alajs));

  done();

});

function defaultTask(cb) {
    // place code for your default task here
    cb();
  }

exports.default = defaultTask;
