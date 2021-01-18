import gulp from 'gulp'
import scss from './scss'
import cssVendor from './cssVendor'
import js from './js'
import jsVendor from './jsVendor'
import json from './json'
import img from './img'
import svg from './svg'
import font from './font'
import reload from './reload'

import { src } from './../paths'

// Watch files.
const watchFiles = () => {
	gulp.watch(src.scss, scss)
	gulp.watch(src.cssVendor, cssVendor)
	gulp.watch(src.js, gulp.series(js, reload))
	gulp.watch(src.jsVendor, gulp.series(jsVendor, reload))
	gulp.watch(src.json, json)
	gulp.watch(src.img, gulp.series(img, reload))
	gulp.watch(src.svg, gulp.series(svg, reload))
	gulp.watch(src.font, gulp.series(font, reload))
	gulp.watch(src.php, reload)
}

export default watchFiles
