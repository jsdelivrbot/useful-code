var path = require('path');
var entries = require('webpack-entries');
var autoprefixer = require('autoprefixer');

module.exports = {
    // entry: entries('./src/*.js', true),
    // output: {
    //     path: path.resolve(__dirname, 'dist'),
    //     filename: '[name].js'
    // },
    module: {
        rules: [{
            test: /\.(js|jsx)$/,
            exclude: /(node_modules|bower_components)/,
            use: [{
                loader: 'babel-loader',
                options: {
                    // presets: ['es2015', 'react'],
                    // plugins: [
                    //     'async-to-promises'
                    // ]
                }
            }]
        }, {
            test: /\.vue$/,
            use: [{
                loader: 'vue-loader',
                options: {
                    preserveWhitespace: false,
                    postcss: [autoprefixer({
                        browsers: ['last 7 versions']
                    })],
                    loaders: {
                        'js': 'babel-loader'
                    }
                }
            }]
        }]
    },
    resolve: {
        alias: {
            vue: 'vue/dist/vue.js'  //不加就會失敗幹你娘不知為啥
        }
    }
};