const path = require('path');
const glob = require('glob');
const entryPlus = require('webpack-entry-plus');

const entryFiles = [
	{
        entryFiles: glob.sync('./web/app/themes/**/parts/**/*index.js'),
        outputName(item) {
            return item.replace('./web', '').replace('index.js', 'index');
        },
    },
    {
        entryFiles: glob.sync('./web/app/themes/**/parts/**/*index.ts'),
        outputName(item) {
            return item.replace('./web', '').replace('index.ts', 'index');
        },
    },
    {
        entryFiles: glob.sync('./web/app/themes/**/js/script.ts'),
        outputName(item) {
            return item.replace('./web', '').replace('script.ts', 'bundle');
        },
    },
    {
        entryFiles: glob.sync('./web/app/themes/**/js/admin-script.js'),
        outputName(item) {
            return item
                .replace('./web', '')
                .replace('admin-script.js', 'admin-bundle');
        },
    },
];

const settings = {
    entry: entryPlus(entryFiles),
    output: {
        path: path.resolve(__dirname, 'web'),
        filename: '[name].min.js',
    },

    resolve: {
        extensions: ['.js', '.ts', '.tsx'],
        alias: {
            Base: path.resolve(glob.sync('web/app/themes/**/js')[0]),
        },
        modules: [
            path.resolve(glob.sync('web/app/themes/**/js')[0]),
            path.resolve(__dirname, 'node_modules'),
        ],
    },

    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    // https://webpack.js.org/loaders/babel-loader/
                    loader: 'babel-loader',
                    options: {
                        plugins: [
                            [
                                '@babel/plugin-proposal-class-properties',
                                { loose: true },
                            ],
                            [
                                '@babel/plugin-proposal-object-rest-spread',
                                { loose: true },
                            ],
                            [
                                '@babel/plugin-proposal-private-methods',
                                { loose: true },
                            ],
                            [
                                '@babel/plugin-proposal-private-property-in-object',
                                { loose: true },
                            ],
                        ],
                        presets: ['@babel/env', '@babel/preset-react'],
                    },
                },
            },

            {
                test: /\.(ts?)$/,
                use: [
                    {
                        loader: 'ts-loader',
                        options: {
                            configFile: 'tsconfig.unstrict.json',
                        },
                    },
                ],
                exclude: /node_modules/,
            },
        ],
    },

    mode: 'development',
};

module.exports = settings;
