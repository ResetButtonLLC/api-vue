module.exports = {
	publicPath: 'assets',
	outputDir: '../public/assets',
	assetsDir: '',
	// https://cli.vuejs.org/ru/guide/html-and-static-assets.html#%D0%BE%D1%82%D0%BAn%D1%8E%D1%87%D0%B5%D0%BD%D0%B8%D0%B5-%D0%B3%D0%B5%D0%BD%D0%B5%D1%80%D0%B0%D1%86%D0%B8%D0%B8-index-html
	filenameHashing: false, // отключение хэшей в именах файлов
	// удаление плагинов webpack связанных с HTML
	chainWebpack: config => {
		config.plugins.delete('html')
		config.plugins.delete('preload')
		config.plugins.delete('prefetch')
	}
}