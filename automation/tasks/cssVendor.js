import gulp from 'gulp'
import plumber from 'gulp-plumber'
import notify from 'gulp-notify'
import postCss from 'gulp-postCss'
import minify from 'gulp-uglifycss'
import browserSync from 'browser-sync'

import { src, dest } from './../paths'

const cssVendor = () => {
	return gulp
		.src(src.cssVendor)
		.pipe(
			plumber({ errorHandler: notify.onError('Error: <%= error.message %>') })
		)
		.pipe(postCss())
		.pipe(minify())
		.pipe(gulp.dest(dest.cssVendor))
		.pipe(browserSync.stream())
}

export default cssVendor
