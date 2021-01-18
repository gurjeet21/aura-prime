import gulp from 'gulp'
import plumber from 'gulp-plumber'
import notify from 'gulp-notify'
import svgSprite from 'gulp-svg-sprite'
import svgmin from 'gulp-svgmin'

import { src, dest } from '../paths'

const svg = () => {
	return (
		gulp
			.src(src.svg)
			.pipe(
				plumber({ errorHandler: notify.onError('Error: <%= error.message %>') })
			)
			// Minify svg.
			.pipe(
				svgmin({
					js2svg: {
						pretty: true,
					},
				})
			)
			// Build svg sprite.
			.pipe(
				svgSprite({
					mode: {
						symbol: {
							sprite: '../sprite.svg',
						},
					},
				})
			)
			.pipe(gulp.dest(dest.svg))
	)
}

export default svg
