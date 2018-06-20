var gulp = require('gulp'),
  postcss = require('gulp-postcss'),
  reporter = require('postcss-reporter');
  livereload = require('gulp-livereload'),
  gulpIf = require('gulp-if'),
  sass = require('gulp-sass'),
  stylelint = require('stylelint'),
  autoprefixer = require('gulp-autoprefixer'),
  sourcemaps = require('gulp-sourcemaps'),
  imagemin = require('gulp-imagemin'),
  pngquant = require('imagemin-pngquant');

gulp.task('imagemin', function () {
  return gulp.src('./images/*')
    .pipe(imagemin({
      progressive: true,
      svgoPlugins: [{removeViewBox: false}],
      use: [pngquant()]
    }))
  .pipe(gulp.dest('./images'));
});


gulp.task('sass', function () {
  gulp.src('./sass/**/*.scss')
    .pipe(sourcemaps.init())
        .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
        .pipe(autoprefixer('last 2 version'))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('./css'));
});

gulp.task('watch', function(){
    livereload.listen();
    gulp.watch('./sass/**/*.scss', ['sass']);
    gulp.watch(['./css/style.css', './**/*.html.twig', './js/*.js'], function (files){
        livereload.changed(files)
    });
});

gulp.task("css-lint", function() {
  // Stylelint config rules
  var stylelintConfig = {
    "rules": {
      "block-no-empty": true,
      "color-no-invalid-hex": true,
      "declaration-colon-space-after": "always",
      "declaration-colon-space-before": "never",
      "function-comma-space-after": "always",
      "function-url-quotes": "double",
      "media-feature-colon-space-after": "always",
      "media-feature-colon-space-before": "never",
      "media-feature-name-no-vendor-prefix": true,
      "max-empty-lines": 5,
      "number-leading-zero": "never",
      "number-no-trailing-zeros": true,
      "property-no-vendor-prefix": true,
      "rule-no-duplicate-properties": true,
      "declaration-block-no-single-line": true,
      "rule-trailing-semicolon": "always",
      "selector-list-comma-space-before": "never",
      "selector-list-comma-newline-after": "always",
      "selector-no-id": true,
      "string-quotes": "double",
      "value-no-vendor-prefix": true
    }
  }
  var processors = [
    stylelint(stylelintConfig),
    // Pretty reporting config
    reporter({
      clearMessages: true,
      throwError: true
    })
  ];

  return gulp.src(
      // Stylesheet source:
      ['./css/style.css']
    )
    .pipe(postcss(processors));
});

gulp.task('lint-css', function lintCssTask() {
  const gulpStylelint = require('gulp-stylelint');
  return gulp
    .src('css/style.css')
    .pipe(gulpStylelint({
      reporters: [
        {formatter: 'string', console: true}
      ]
    }));
});
