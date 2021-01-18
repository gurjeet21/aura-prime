import browserSync from 'browser-sync'

import config from './../config'

const serve = (done) => {
	browserSync.init({
		host: config.siteUrl,
		proxy: config.siteUrl,
		port: 3000,
		open: false,
	})

	done()
}

export default serve
