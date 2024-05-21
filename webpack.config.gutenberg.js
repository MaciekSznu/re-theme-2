delete require.cache[require.resolve('./webpack.config')];

const entryPlus = require('webpack-entry-plus');
const glob = require('glob');
const baseSettings = require('./webpack.config');

const getGutenbergConfig = () => {
    const mainSettings = { ...baseSettings };
    const blockGlob = './web/app/themes/**/parts/blocks/**/*admin.js';
    const entryFiles = glob.sync(blockGlob);

    if (entryFiles.length > 0) {
        const blockEntryFiles = [
            {
                entryFiles,
                outputName(item) {
                    return item.replace('./web', '').replace('.js', '');
                },
            },
        ];

        mainSettings.entry = entryPlus(blockEntryFiles);

        // Add react preset
        mainSettings.module.rules[0].use.options.presets = [
            ['@babel/preset-react'],
        ];
        return mainSettings;
    }

    return null;
};

module.exports = getGutenbergConfig();
