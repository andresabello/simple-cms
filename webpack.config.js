const path = require('path')
const { VueLoaderPlugin } = require('vue-loader')
const CopyPlugin = require('copy-webpack-plugin')
const ManifestPlugin = require('webpack-manifest-plugin')
const { CleanWebpackPlugin } = require('clean-webpack-plugin')
const ExtractTextPlugin = require('extract-text-webpack-plugin')

const backend = (env) => {
    const isProduction = typeof env !== 'undefined' &&
        typeof env.NODE_ENV !== 'undefined' &&
        env.NODE_ENV === 'production'

    return {
        mode: isProduction ? 'production' : 'development',
        watch: false,
        watchOptions: {
            aggregateTimeout: 300,
            poll: 1000,
            ignored: ['node_modules'],
        },
        optimization: {
            moduleIds: 'hashed',
            minimize: true,
            runtimeChunk: 'single',
            splitChunks: {
                cacheGroups: {
                    vendor: {
                        test: /[\\/]node_modules[\\/]/,
                        name: 'vendors',
                        chunks: 'all',
                    },
                },
            },
        },
        entry: {
            backend: [
                './src/resources/core/assets/js/backend.js',
                './src/resources/core/assets/scss/backend.scss',
            ],
        },
        output: {
            path: path.resolve(__dirname, 'src/resources/core/assets/dist'),
            publicPath: '/vendor/simple-cms/backend/assets/dist/',
            filename: '[name].[hash].js',
        },
        resolve: {
            alias: {
                'vue$': 'vue/dist/vue.esm.js',
            },
            extensions: ['*', '.js', '.vue', '.json'],
        },
        module: {
            rules: [
                {
                    test: /\.txt$/,
                    use: 'raw-loader',
                },
                {
                    test: /\.vue$/,
                    use: 'vue-loader',
                },
                {
                    test: /\.m?js$/,
                    exclude: /(node_modules)/,
                    use: {
                        loader: 'babel-loader',
                        options: {
                            presets: [
                                [
                                    '@babel/preset-env',
                                    {
                                        'debug': true,
                                        corejs: 3,
                                        'useBuiltIns': 'entry',
                                        'targets': {
                                            'browsers': [
                                                'defaults',
                                            ],
                                        },
                                    },
                                ],
                            ],
                            plugins: [
                                '@babel/transform-runtime',
                            ],
                        },
                    },
                },
                {
                    test: /\.scss$/,
                    use: ExtractTextPlugin.extract({
                        fallback: 'vue-style-loader',
                        use: [
                            {
                                loader: 'css-loader',
                                options: {
                                    url: false,
                                    sourceMap: true,
                                },
                            },
                            {
                                loader: 'sass-loader',
                                options: {
                                    sourceMap: true,
                                },
                            },
                        ],
                    }),
                },
                {
                    test: /\.css$/,
                    loader: 'vue-style-loader!css-loader',
                },
            ],
        },
        plugins: [
            new VueLoaderPlugin(),
            new ExtractTextPlugin({
                filename: '[name].[hash].css',
                allChunks: true,
            }),
            new CopyPlugin([
                {
                    from: './node_modules/@fortawesome/fontawesome-free/webfonts',
                    to: './webfonts/',
                },
            ]),
            new CleanWebpackPlugin(),
            new ManifestPlugin(),
        ],
    }
}

const frontend = (env) => {
    const isProduction = typeof env !== 'undefined' &&
        typeof env.NODE_ENV !== 'undefined' &&
        env.NODE_ENV === 'production'

    return {
        mode: isProduction ? 'production' : 'development',
        watch: false,
        watchOptions: {
            aggregateTimeout: 300,
            poll: 1000,
            ignored: ['node_modules'],
        },
        optimization: {
            moduleIds: 'hashed',
            minimize: true,
            runtimeChunk: 'single',
            splitChunks: {
                cacheGroups: {
                    vendor: {
                        test: /[\\/]node_modules[\\/]/,
                        name: 'vendors',
                        chunks: 'all',
                    },
                },
            },
        },
        entry: {
            frontend: [
                './src/resources/themes/default/assets/js/frontend.js',
                './src/resources/themes/default/assets/scss/frontend.scss',
            ],
        },
        output: {
            path: path.resolve(__dirname, 'src/resources/themes/default/assets/dist'),
            publicPath: '/vendor/simple-cms/themes/default/assets/dist/',
            filename: '[name].[hash].js',
        },
        resolve: {
            alias: {
                'vue$': 'vue/dist/vue.esm.js',
            },
            extensions: ['*', '.js', '.vue', '.json'],
        },
        module: {
            rules: [
                {
                    test: /\.txt$/,
                    use: 'raw-loader',
                },
                {
                    test: /\.vue$/,
                    use: 'vue-loader',
                },
                {
                    test: /\.m?js$/,
                    exclude: /(node_modules)/,
                    use: {
                        loader: 'babel-loader',
                        options: {
                            presets: [
                                [
                                    '@babel/preset-env',
                                    {
                                        'debug': true,
                                        corejs: 3,
                                        'useBuiltIns': 'entry',
                                        'targets': {
                                            'browsers': [
                                                'defaults',
                                            ],
                                        },
                                    },
                                ],
                            ],
                            plugins: [
                                '@babel/transform-runtime',
                            ],
                        },
                    },
                },
                {
                    test: /\.scss$/,
                    use: ExtractTextPlugin.extract({
                        fallback: 'vue-style-loader',
                        use: [
                            {
                                loader: 'css-loader',
                                options: {
                                    url: false,
                                    sourceMap: true,
                                },
                            },
                            {
                                loader: 'sass-loader',
                                options: {
                                    sourceMap: true,
                                },
                            },
                        ],
                    }),
                },
                {
                    test: /\.css$/,
                    loader: 'vue-style-loader!css-loader',
                },
            ],
        },
        plugins: [
            new VueLoaderPlugin(),
            new ExtractTextPlugin({
                filename: '[name].[hash].css',
                allChunks: true,
            }),
            new CopyPlugin([
                {
                    from: './node_modules/@fortawesome/fontawesome-free/webfonts',
                    to: './webfonts/',
                },
            ]),
            new CleanWebpackPlugin(),
            new ManifestPlugin(),
        ],
    }
}

module.exports = [
    backend, frontend
]
