import browserSync from 'browser-sync'

const reload = (done) => {
	browserSync.reload()
	done()
}

export default reload
