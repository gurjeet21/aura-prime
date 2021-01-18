import gulp from 'gulp'
import plumber from 'gulp-plumber'
import notify from 'gulp-notify'
import minify from 'gulp-uglify'
import browserSync from 'browser-sync'

import { src, dest } from './../paths'

const jsVendor = () => {
	return gulp
		.src(src.jsVendor)
		.pipe(
			plumber({ errorHandler: notify.onError('Error: <%= error.message %>') })
		)
		.pipe(minify({ output: { comments: /^!/ } }))
		.pipe(gulp.dest(dest.jsVendor))
		.pipe(browserSync.stream())
}

export default jsVendor
