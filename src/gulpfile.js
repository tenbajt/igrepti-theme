const fs = require('fs');
const gulp = require('gulp');
const mode = require('gulp-mode')();
const concat = require('gulp-concat');

/**
|--------------------------------------------------------------------------
| Local functions
|--------------------------------------------------------------------------
*/

const tailwind = (dir) => {
  	return gulp.src(`assets/css/${dir}/styles.css`)
    	.pipe(require('gulp-postcss')([
      		require('tailwindcss'),
      		require('autoprefixer'),
    	]))
		.pipe(concat(`${dir}.css`))
    	.pipe(gulp.dest('../dist/css'));
}

const js = (dir) => {
	return gulp.src(`assets/js/${dir}/**/*.js`)
		.pipe(mode.production(require('gulp-babel')()))
		.pipe(mode.production(require('gulp-uglify')()))
		.pipe(concat(`${dir}.js`))
		.pipe(gulp.dest('../dist/js'));
}

const scss = (dir) => {
	var $postcssPlugins = [require('autoprefixer')];

	if (mode.production()) {
		$postcssPlugins.push(require('cssnano'));
	}

	return gulp.src(`assets/scss/${dir}/**/*.scss`)
		.pipe(require('gulp-dart-sass')())
		.pipe(require('gulp-postcss')($postcssPlugins))
		.pipe(concat(`${dir}.css`))
		.pipe(gulp.dest('../dist/css'));
}

/**
|--------------------------------------------------------------------------
| Task functions
|--------------------------------------------------------------------------
*/

const themejs = () => {
	return js('theme');
}

const admincss = () => {
	return scss('admin');
}

const themecss = () => {
	//return scss('theme');
	return tailwind('theme');
}

/**
|--------------------------------------------------------------------------
| Exported functions
|--------------------------------------------------------------------------
*/

exports.watch = () => {
	gulp.watch('assets/js/theme/**/*.js', themejs);
	gulp.watch([
		'../index.php',
		'../footer.php',
		'../header.php',
		'../woocommerce/**/*.php',
		'../page-templates/**/*.php',
		'../partial-templates/**/*.php',
	], themecss);
	gulp.watch('assets/scss/admin/**/*.scss', admincss);
	//gulp.watch('assets/scss/theme/**/*.scss', themecss);
}

exports.themejs = themejs;
exports.admincss = admincss;
exports.themecss = themecss;

exports.build = gulp.parallel(admincss, themecss, themejs);
