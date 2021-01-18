import gulp from 'gulp'
import plumber from 'gulp-plumber'
import notify from 'gulp-notify'
import imagemin from 'gulp-imagemin'

import { src, dest } from '../paths'

const img = () => {
	return gulp
		.src(src.img)
		.pipe(
			plumber({ errorHandler: notify.onError('Error: <%= error.message %>') })
		)
		.pipe(imagemin())
		.pipe(gulp.dest(dest.img))
}

export default img
