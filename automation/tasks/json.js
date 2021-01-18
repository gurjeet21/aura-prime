import gulp from 'gulp'
import plumber from 'gulp-plumber'
import notify from 'gulp-notify'
import minify from 'gulp-jsonmin'

import { src, dest } from './../paths'

const json = () => {
	return gulp
		.src(src.json)
		.pipe(
			plumber({ errorHandler: notify.onError('Error: <%= error.message %>') })
		)
		.pipe(minify())
		.pipe(gulp.dest(dest.json))
}

export default json
