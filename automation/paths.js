const entryPoints = {
	app: './src/js/app.js',
	'contact-form-7': './inc/Plugins/ContactForm7/src/js/contact-form-7.js',
	elementor: './inc/Plugins/Elementor/src/js/elementor.js',
	kirki: './inc/Plugins/Kirki/src/js/kirki.js',
	woocommerce: './inc/Plugins/WooCommerce/src/js/woocommerce.js',
}

const srcFolders = [
	'./src',
	'./inc/Admin/Branding/src',
	'./inc/Plugins/ContactForm7/src',
	'./inc/Plugins/Elementor/src',
	'./inc/Plugins/Kirki/src',
	'./inc/Plugins/WooCommerce/src',
]

const getsrcFolders = (type) => {
	const folders = []

	srcFolders.forEach((folder) => {
		folders.push(`${folder}/${type}`)
	})

	return folders
}

const src = {
	scss: getsrcFolders('scss/**/*.scss'),
	js: [...getsrcFolders('js/*.js'), ...getsrcFolders('js/modules/**/*.js')],
	cssVendor: getsrcFolders('css/*.css'),
	jsVendor: getsrcFolders('js/vendor/*.js'),
	json: getsrcFolders('json/*.json'),
	img: getsrcFolders('img/**'),
	svg: getsrcFolders('svg/**/*.svg'),
	font: getsrcFolders('font/**'),
	php: './**/*.php',
	zip: [
		'./**',
		'!**/automation/**',
		'!**/node_modules/**',
		'!**/src/**',
		'./**/vendor/**/src/**',
		'!**/.babelrc',
		'!**/.editorconfig',
		'!**/.eslintrc.json',
		'!**/.gitignore',
		'!**/.prettierrc',
		'!**/.stylelintrc',
		'!**/CHANGELOG.md',
		'!**/composer.json',
		'!**/composer.lock',
		'!**/Gruntfile.js',
		'!**/gulpfile.babel.js',
		'!**/LICENSE',
		'!**/package.json',
		'!**/package-lock.json',
		'!**/phpcs.xml',
		'!**/postcss.config.js',
		'!**/README.md',
		'!**/webpack.config.babel.js',
		'!**/yarn.lock',
		'!./vendor/bin/**',
		'!./vendor/dealerdirect/**',
		'!./vendor/phpcompatibility/**',
		'!./vendor/squizlabs/**',
		'!./vendor/wp-coding-standards/**',
	],
}

const dest = {
	scss: './dist/css',
	cssVendor: './dist/css/vendor',
	js: './dist/js',
	jsVendor: './dist/js/vendor',
	json: './dist/json',
	img: './dist/img',
	svg: './dist/img',
	font: './dist/font',
	zip: './../',
}

export { src, dest, entryPoints }
