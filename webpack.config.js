const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const { VueLoaderPlugin } = require('vue-loader')
const webpack = require('webpack')

module.exports = {
    mode: "development", // production || development
    devtool: 'inline-source-map',
    entry: {
        app: './asset/app.js',
        admin: './asset/admin.js',
        main : './asset/main.js',
        chart : './asset/chart.js'
        //admin: './src/admin.js',
    },
    output: {
        filename: 'js/[name].bundle.js',
        path: path.join(__dirname, 'public', 'dist'), // en dev ici , en prod dans le dossier public/ prod & un dossier thmes avec image svg etc , mais qui reste fixe
        clean: true,
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: 'css/style-[name].bundle.css',
        }),
        new VueLoaderPlugin(),
        new webpack.DefinePlugin({
            'process.env': JSON.stringify(process.env)
        })
    ],
    externals : {
        //vue: 'Vue',
        //vuex: 'Vuex',
        // 'vue-router': 'VueRouter'
        // Axios ?? aussi oui ++
    },
    module: {
        rules: [
            {
                test: /\.vue$/,
                loader: 'vue-loader'
            },
            {
                test: /\.m?js$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: [
                            ['@babel/preset-env', {
                                useBuiltIns: "usage",
                                corejs: 3,
                                targets: "> 0.25%, not dead",
                            }]
                        ]
                    }
                }
            },
            {
                test: /\.s?css$/,
                use: [
                    MiniCssExtractPlugin.loader, 'css-loader', "sass-loader","postcss-loader"
                ],
            },
            {
                test: /\.(woff|woff2|eot|ttf|otf)$/i,
                type: 'asset/resource',
            },
            {
                test: /\.(png|svg|jpg|jpeg|gif)$/i,
                type: 'asset/resource',
            },
        ]
    },
    devServer: {
        static: {
            directory: path.join(__dirname, "public/dist"),
        },
        compress: true,
        hot: true,
        port: 4000,
        devMiddleware: {
            index: true,
            mimeTypes: { 'text/html': ['phtml'] },
            publicPath: '/publicPathForDevServe',
            serverSideRender: true,
            writeToDisk: true,
        },
    },
};

