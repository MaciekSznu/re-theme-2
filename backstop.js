// Url is in .env. This gives the scenarios that are just
// required here access to environmental variables.
require('dotenv').config();

const viewports = require('./backstop_data/viewports');

module.exports = {
    id: 'backstop_default',
    viewports: [
        viewports.phone,
        viewports.tabletLandscape,
        viewports.tabletPortrait,
        viewports.desktop
    ],
    onBeforeScript: 'puppet/onBefore.js',
    onReadyScript: 'puppet/onReady.js',
    scenarios: [
        ...require('./backstop_data/scenarios/home')
    ],
    paths: {
        bitmaps_reference: 'backstop_data/bitmaps_reference',
        bitmaps_test: 'backstop_data/bitmaps_test',
        engine_scripts: 'backstop_data/engine_scripts',
        html_report: 'backstop_data/html_report',
        ci_report: 'backstop_data/ci_report'
    },
    report: [
        'browser'
    ],
    engine: 'puppeteer',
    engineOptions: {
        args: [
            '--no-sandbox'
        ]
    },
    asyncCaptureLimit: 5,
    asyncCompareLimit: 50,
    debug: false,
    debugWindow: false
};
