import gulp from 'gulp'
import plumber from 'gulp-plumber'
import notify from 'gulp-notify'

import { src, dest } from '../paths'

const font = () => {
	return gulp
		.src(src.font)
		.pipe(
			plumber({ errorHandler: notify.onError('Error: <%= error.message %>') })
		)
		.pipe(gulp.dest(dest.font))
}

export default font
