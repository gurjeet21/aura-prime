import gulp from 'gulp'
import plumber from 'gulp-plumber'
import notify from 'gulp-notify'

import { src, dest } from './../paths'

const fonts = () => {
	return gulp
		.src(src.fonts)
		.pipe(
			plumber({ errorHandler: notify.onError('Error: <%= error.message %>') })
		)
		.pipe(gulp.dest(dest.fonts))
}

export default fonts
