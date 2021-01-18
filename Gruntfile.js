/* eslint no-undef: 0 */

const pkg = require('./package.json')

module.exports = function (grunt) {
	grunt.initConfig({
		checktextdomain: {
			options: {
				text_domain: pkg.name,
				keywords: [
					'__:1,2d',
					'_e:1,2d',
					'_x:1,2c,3d',
					'esc_html__:1,2d',
					'esc_html_e:1,2d',
					'esc_html_x:1,2c,3d',
					'esc_attr__:1,2d',
					'esc_attr_e:1,2d',
					'esc_attr_x:1,2c,3d',
					'_ex:1,2c,3d',
					'_n:1,2,4d',
					'_nx:1,2,4c,5d',
					'_n_noop:1,2,3d',
					'_nx_noop:1,2,3c,4d',
				],
			},
			files: {
				src: ['**/*.php', '!**/node_modules/**'],
				expand: true,
			},
		},

		addtextdomain: {
			options: {
				textdomain: pkg.name,
				updateDomains: [],
			},
			target: {
				files: {
					src: ['**/*.php', '!**/node_modules/**'],
				},
			},
		},

		makepot: {
			target: {
				options: {
					type: 'wp-theme',
					domainPath: 'languages',
					exclude: ['node_modules'],
				},
			},
		},
	})

	// i18n
	grunt.loadNpmTasks('grunt-checktextdomain')
	grunt.loadNpmTasks('grunt-wp-i18n')

	// Tasks
	grunt.registerTask('i18n', ['checktextdomain', 'makepot'])
	grunt.registerTask('fix-i18n', ['addtextdomain', 'i18n'])
}
