/* globals process */

import run from 'gulp-run-command'

const mode = process.env.NODE_ENV ? process.env.NODE_ENV : 'production'

const js = run(`webpack --mode ${mode}`)

export default js
