// 這邊使用 HtmlWebpackPlugin，將 bundle 好得 <script> 插入到 body
const HtmlWebpackPlugin = require('html-webpack-plugin');

const HTMLWebpackPluginConfig = new HtmlWebpackPlugin({
    template: `${__dirname}/index.html`,
    filename: 'index.html',
    inject: 'body',
});

const UglifyJSPlugin = require('uglifyjs-webpack-plugin');

var webpack = require('webpack');
var path = require('path');

module.exports = {
    devtool: 'inline-source-map',
    entry: [
        'webpack-dev-server/client?http://127.0.0.1:8080/',
        'webpack/hot/only-dev-server',
        './src'
    ],
    output: {
        path: path.join(__dirname, 'public'),
        filename: 'bundle.js'
    },
    resolve: {
        modulesDirectories: ['node_modules', 'src'],
        extensions: ['', '.js']
    },
    module: {
        loaders: [{
            test: /\.jsx?$/,
            exclude: /node_modules/,
            loaders: ['react-hot', 'babel?presets[]=react,presets[]=es2015']
        }, {
            test: /\.scss$/,
            exclude: /node_modules/,
            loaders: ['style', 'css', 'sass']
        }]
    },
    plugins: [
        new webpack.HotModuleReplacementPlugin(),
        new webpack.NoErrorsPlugin(),
        new UglifyJSPlugin(),
        HTMLWebpackPluginConfig
    ]
};