const gulp = require('gulp'),
    sass = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    cleanCSS = require('gulp-clean-css'),
    sourcemaps = require('gulp-sourcemaps'),
    babel = require('gulp-babel'),
    uglify = require('gulp-uglify'),
    del = require('del'),
    concat = require('gulp-concat'),
    plumber = require('gulp-plumber'),
    php = require('gulp-connect-php'),
    browserSync = require('browser-sync').create();

gulp.task('php', function () {
    php.server({base: './', port: 80, keepalive: true});
});

function scss() {
    return gulp.src(
        [
            'node_modules/normalize.css/normalize.css',
            'src/scss/*.scss'
        ])
        .pipe(sourcemaps.init())
        .pipe(plumber())
        .pipe(sass())
        .pipe(autoprefixer())
        .pipe(cleanCSS({
            level: {
                1: {
                    specialComments: 0
                }
            }
        }))
        .pipe(concat("style.css"))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('css'))
        .pipe(browserSync.stream());
}

function js() {
    return gulp.src(
        [
            'src/js/script.js',
        ])
        .pipe(plumber())
        .pipe(babel())
        .pipe(uglify())
        .pipe(concat("bundle.js"))
        .pipe(gulp.dest("js"))
        .pipe(browserSync.stream());
}

function clean() {
    return del(['css/style.css', 'js/bundle.js'])
}

gulp.task('scss', scss);
gulp.task('js', js);

function watch() {
    browserSync.init({
        // proxy: "localhost/GribMarket/",
        proxy: "localhost/gipermarket/",
        baseDir: "./",
        open: true,
        notify: false
    });

    gulp.watch('src/scss/*.scss', scss);
    gulp.watch('src/js/script.js', js);
    gulp.watch("*.php").on('change', browserSync.reload);
    // gulp.watch('src/script.js', js);
}


gulp.task('watch', watch);

gulp.task('build', gulp.series(
    clean,
    gulp.parallel(scss, js)
));

gulp.task('default', gulp.series('build', 'watch'));