//webpack.config.js
var ExtractTextPlugin = require('extract-text-webpack-plugin');
var webpack = require('webpack');

module.exports = function (env) {
    return {
        entry: [
            './js/app.js',
            './styles/main.scss'
        ],
        output: {
            path: __dirname + "/dist",
            filename: "bundle.js"
        },
        module: {
            rules: [
                {
                    test: /\.js$/,
                    exclude: /(node_modules|bower_components)/,
                    use: {
                        loader: 'babel-loader',
                        options: {
                            presets: ['env']
                        }
                    }
                },
                {
                    test: /\.scss$/,
                    use: ExtractTextPlugin.extract({
                        fallback: 'style-loader',
                        //resolve-url-loader may be chained before sass-loader if necessary
                        use: ['css-loader', 'sass-loader']
                    })
                }
            ]
        },
        plugins: [
            new ExtractTextPlugin('main.css', {
                allChunks: true
            })
        ]
    }
}