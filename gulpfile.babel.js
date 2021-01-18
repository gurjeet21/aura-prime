import gulp from 'gulp'
import grunt from 'gulp-grunt'

grunt(gulp)

import clean from './automation/tasks/clean'
import scss from './automation/tasks/scss'
import cssVendor from './automation/tasks/cssVendor'
import js from './automation/tasks/js'
import jsVendor from './automation/tasks/jsVendor'
import json from './automation/tasks/json'
import img from './automation/tasks/img'
import svg from './automation/tasks/svg'
import font from './automation/tasks/font'
import serve from './automation/tasks/serve'
import watchFiles from './automation/tasks/watchFiles'
import zipFiles from './automation/tasks/zipFiles'

const i18n = gulp.series('grunt-i18n')
const fixI18n = gulp.series('grunt-fix-i18n')

const build = gulp.series(
	clean,
	gulp.parallel(scss, cssVendor, js, jsVendor, json, img, svg, font)
)

const watch = gulp.series(build, gulp.parallel(watchFiles, serve))

const zip = gulp.series(build, zipFiles)

export { build, watch, i18n, fixI18n, zip }
