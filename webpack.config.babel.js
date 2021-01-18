/* globals __dirname */

import path from 'path'

import { entryPoints } from './automation/paths'

export default (env, argv) => {
	const production = argv.mode === 'production' ? true : false

	return {
		entry: entryPoints,

		output: {
			path: path.resolve(__dirname, 'dist/js'),
		},

		module: {
			rules: [
				{
					test: /\.js$/,
					exclude: /node_modules/,
					use: 'babel-loader',
				},
			],
		},

		devtool: production === true ? '' : 'eval',

		stats: {
			entrypoints: false,
			modules: false,
			version: false,
		},
	}
}
