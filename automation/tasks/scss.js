import gulp from 'gulp'
import plumber from 'gulp-plumber'
import notify from 'gulp-notify'
import sass from 'gulp-sass'
import postCss from 'gulp-postCss'
import minify from 'gulp-uglifycss'
import browserSync from 'browser-sync'

import { src, dest } from './../paths'

const scss = () => {
	return gulp
		.src(src.scss)
		.pipe(
			plumber({ errorHandler: notify.onError('Error: <%= error.message %>') })
		)
		.pipe(
			sass({
				outputStyle: 'expanded',
				precision: 10,
			})
		)
		.pipe(postCss())
		.pipe(minify())
		.pipe(gulp.dest(dest.scss))
		.pipe(browserSync.stream())
}

export default scss
