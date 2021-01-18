import gulp from 'gulp'
import zip from 'gulp-zip'
import del from 'del'

import { src, dest } from '../paths'
import pkg from './../../package.json'

const zipFileName = pkg.name + '.zip'

const deleteZipFile = () => {
	return del(dest.zip + zipFileName, { force: true })
}

const createZipFile = (cb) => {
	gulp.src(src.zip).pipe(zip(zipFileName)).pipe(gulp.dest(dest.zip))
	cb()
}

export default gulp.series(deleteZipFile, createZipFile)
