const fs = require('fs');
const path = require('path');
const gulp = require('gulp');
const gulpSass = require('gulp-sass')(require('sass'));
const through = require('through2');
const glob = require('glob');
const webpack = require('webpack');
const zip = require('gulp-zip');
const wait = require('gulp-wait');
const async = require('async');
const iconfont = require('gulp-iconfont');
const sourcemaps = require('gulp-sourcemaps');
const consolidate = require('gulp-consolidate');
const browserSync = require('browser-sync');
const wpcli = require('./env/wpcli');
const getArguments = require('./env/getArguments');
const gulpStylelint = require('gulp-stylelint');
const stripBom = require('gulp-stripbom');
const gulpif = require('gulp-if');
const { promisify } = require('util');

const readFile = promisify(fs.readFile);
const writeFile = promisify(fs.writeFile);

require('dotenv').config();

getArguments.parse();

const dist = 'web';
const cssFile = 'css';

const appArguments = getArguments();
const production = !!appArguments.production;
const stylesAndReload = process.env.STYLES_AND_RELOAD === '1' ? true : false;
const runTimestamp = Math.round(Date.now() / 1000);

/*
 * Create iconfont fonts and styles.
 * You can create iconfont by uploading svg to images/svg folder in your theme
 *
 */
gulp.task('iconfont', function (done) {
	const iconStream = gulp.src([`${dist}/app/themes/reTheme2/images/svg/**/*`])
		.pipe(iconfont({
                fontName: `iconfont-reTheme2`,
                normalize: true,
                fontHeight: 1001,
                formats: ['ttf', 'eot', 'woff', 'woff2', 'svg'],
                timestamp: runTimestamp,
		}));

	async.parallel([
            function handleGlyphs(cb) {
                iconStream.on('glyphs', function (glyphs, options) {
				async.parallel([
                            function iconfontTemplate(cb) {
						gulp.src(`${dist}/app/themes/reTheme2/css/iconfont/_iconfont.{sass,scss}`)
						.pipe(consolidate('lodash', {
                                            glyphs,
							fontCacheBuster: Math.random().toString(36).substring(7),
                                            fontName: `iconfont-reTheme2`,
                                            themePath: `/themes/reTheme2/`,
                                            fontPath: `fonts/iconfont-reTheme2`,
							className: 'icon'
						}))
						.pipe(gulp.dest(`web/app/themes/reTheme2/css/__iconfont`))
                                    .on('finish', cb);
                            },
                            function iconfontVariables(cb) {
						gulp.src(`${dist}/app/themes/reTheme2/css/iconfont/_iconfont-variables.{sass,scss}`)
							.pipe(consolidate('lodash', {
                                            glyphs,
								fontCacheBuster: Math.random().toString(36).substring(7),
                                            fontName: `iconfont-reTheme2`,
                                            themePath: `/themes/reTheme2/`,
                                            fontPath: `fonts/iconfont-reTheme2`,
								className: 'icon'
							}))
							.pipe(gulp.dest(`${dist}/app/themes/reTheme2/css/__iconfont`))
							.on('finish', cb)
					}
				], done)
                });
            },
            function handleFonts(cb) {
                iconStream
				.pipe(gulp.dest((`${dist}/app/themes/reTheme2/fonts/iconfont-reTheme2`)))
                    .on('finish', cb);
		}
	], done);
});

/**
 * Like regular `require` but invalidates the cache for the module.
 * That means we'll get *a new object* each time we require a file
 * this way. This allows us to safely mutate the the required object
 * (e.g. a config file).
 */
const requireNoCache = (module) => {
    delete require.cache[require.resolve(module)];
    return require(module);
};

/**
 * For reference: https://github.com/wp-cli/search-replace-command/issues/45#issuecomment-554566809
 * This function replace APP_URL from .env to regex.
 * This regex is needed to find and replace APP_URL (in every form) in our db to <-- REPLACE_ADDRESS --> during export db.
 * https?(:(\\\\\/\\\\\/|\/\/)*)(www\.)? - possibility have http or https, http:// or http:\\/\\/ and www. in our APP_URL in .env
 * ${replace_link.replace(/\//g, String.raw`?(\\\\\/|\/\)*)?`)} - replace all '/' in link from APP_URL which doesn't have any http or https to ?(\\\\\/|\/\)*)?
 * Replacement is needed to get REGEX - localhost?(\\\\\/|\/\)*)?projects?(\\\\\/|\/\)*)?project. This regex matches two options of links: localhost/projects/project and localhost\\/projects\\/project.
 * This function is needed to replace all links in database especially for url in ACF Link field in ACF Gutenberg Block which looks like localhost\\/projects\\/project\\/web.
 */
const replaceAddress = url =>{
    const replace_link = url.replace(/^https?\:\/\//i, "");
    return String.raw`https?(:(\\\\\/\\\\\/|\/\/)*)(www\.)?${replace_link.replace(/\//g, String.raw`?(\\\\\/|\/\)*)?`)}`;
}

gulp.task(`styles:all`, () => {
    return gulp
        .src([`${dist}/app/themes/**/*.{sass,scss}`], { base: './' })
        .pipe(gulpStylelint({
                failAfterError: false,
            reporters: [
                {formatter: 'string', console: true}
            ]
        }))
        .pipe(wait(100))
        .pipe(gulpif(!production, sourcemaps.init({loadMaps: true})))

        .pipe(
            gulpSass({
                outputStyle: 'compressed',
                precision: 8,
                includePaths: glob.sync(`./${dist}/app/themes/**/css/`),
            }).on('error', gulpSass.logError)
        )
        .pipe(gulpif(!production, sourcemaps.write()))
        .pipe(gulp.dest('./'));
});

gulp.task("styles:all:watch", () => {
    const watcher = gulp.watch(`${dist}/app/themes/**/*.{sass,scss}`);
	watcher.on("change", (filePath) => {
        const cssFolderName = '/css/';
        const stylesFolderName = '/styles/';
        const repleacedFilePath = filePath.replace(/\\/g, '/');
        let filesPath = '';

        if (repleacedFilePath.includes(stylesFolderName)) {
			filesPath = `${repleacedFilePath.slice(0, repleacedFilePath.lastIndexOf('/styles'))}/*.{sass,scss}`;
        } else if (repleacedFilePath.includes(cssFolderName)) {
			filesPath =`${dist}/app/themes/**/css/**/*.{sass,scss}`
        } else {
            filesPath = repleacedFilePath;
        }

        return gulp
		.src([filesPath], { base: "./" })
            .pipe(
                gulpStylelint({
                    failAfterError: false,
				reporters: [{ formatter: "string", console: true }],
                })
            )
            .pipe(wait(100))
            .pipe(gulpif(!production, sourcemaps.init()))
            .pipe(
                gulpSass({
                    outputStyle: 'compressed',
                    precision: 8,
                    includePaths: glob.sync(`./${dist}/app/themes/**/css/`),
			}).on("error", gulpSass.logError)
            )
            .pipe(gulpif(!production, sourcemaps.write()))
		.pipe(gulp.dest("./"));
    });
});

gulp.task('styles:fixCss', () => {
    return gulp
        .src([`${dist}/app/themes/**/*.${cssFile}`], { base: './' })
        .pipe(stripBom())
        .pipe(gulp.dest('./'));
});

gulp.task('styles:fix', (done) => {
    gulp.src([`${dist}/app/themes/**/*.{sass,scss}`, `!${dist}/app/themes/**/css/__vendors/**/*.{sass,scss}`, `!${dist}/app/themes/**/css/vendors/**/*.{sass,scss}`, `!${dist}/app/themes/**/css/__iconfont/**/*.{sass,scss}`, `!${dist}/app/themes/**/css/iconfont/**/*.{sass,scss}`], { base: './' })
        .pipe(gulpStylelint({
                fix: true,
                failAfterError: false,
            reporters: [
                {formatter: 'string', console: true}
            ]
        }))
        .pipe(gulp.dest('./'))
        .on('finish', done);
});

/*
 * Remove all generated JS bundles.
 * If webpack is configured to add hash to bundles they will not be overriden,
 * so multiple builds just keep adding new files. This task will remove
 * the generated bundles to have fresh build every time.
 */
gulp.task('clean-bundles', () => {
    return gulp.src(`${dist}/app/themes/**/*bundle*.js`).pipe(
        through.obj((chunk, enc, cb) => {
            fs.unlinkSync(chunk.path);
            cb(null, chunk);
        })
    );
});

/*
 * Compile scripts using webpack.
 */

/**
 * @param {string} configName Name of the config file to import.
 * @param {string} name Printed in console to identify the build, for devs convenience.
 * @param {function} cb Gulp callback, passes from task.
 */
const compileWebpack = (configName, name, cb) => {
    if (!fs.existsSync(`${configName}.js`)) {
        cb();
        return;
    }

    const config = requireNoCache(configName);

    // It's possible that config will not exits, because if the entry files' glob from webpack's
    // configuration is empty (such files or directories do not exist) then we don't want to compile
    // webpack for that configuration (thus webpack config will return nothing in that case).
    //
    // We want to have one version of environment that works with both old and new wp frameworks.
    // In the new wp framework separate webpack configuration for compilation of JS files in blocks is needed.
    // In the old wp framework blocks directory (and js files for blocks) do not exist, so it is necessary to add
    // this check below to prevent the build from failing when those files are not found.
    if (!config) {
        cb();
        return;
    }

    if (production) {
        config.mode = 'production';
    }

    console.info(`\n[webpack][${name}]\n`);

    webpack(config, (err, stats) => {
        console.info(
            stats.toString({
                chunks: false, // Makes the build much quieter
                colors: true,
            })
        );

        cb();
    });
};

gulp.task('scripts:default', (cb) => {
    compileWebpack('./webpack.config', 'default', cb);
});

gulp.task('scripts:ie', (cb) => {
    compileWebpack('./webpack.config.ie', 'IE', cb);
});

gulp.task('scripts:gutenberg', (cb) => {
    compileWebpack('./webpack.config.gutenberg', 'gutenberg', cb);
});

gulp.task(
    'scripts',
    gulp.series('scripts:default', 'scripts:ie', 'scripts:gutenberg')
);

const compileOnWatch = (compiler) => {
    // We need a named function here (instead of doing e.g.
    // `compiler => cb =>`), because otherwise gulp displays `<anonymous>`,
    // which is not very helpful.
    // eslint-disable-next-line sonarjs/prefer-immediate-return
    const watchIsCompiling = (cb) => {
        compiler.run((_error, stats) => {
            console.info(
                stats.toString({
                    colors: true,
                })
            );

            console.info();
            cb();
        });
    };

    return watchIsCompiling;
};

gulp.task('scripts:watch:modern', () => {
    const config = requireNoCache('./webpack.config.js');

    const compiler = webpack(config);

    return gulp.watch(
        `${dist}/app/themes/**/*.{js,ts}`,
        compileOnWatch(compiler)
    );
});

gulp.task('scripts:watch:ie', () => {
    if (!fs.existsSync('webpack.config.ie.js')) {
        return;
    }

    const config = requireNoCache('./webpack.config.ie.js');

    if (!config) {
        return;
    }

    const compiler = webpack(config);

    return gulp.watch(
        `${dist}/app/themes/**/*.{js,ts}`,
        compileOnWatch(compiler)
    );
});

gulp.task('scripts:watch:gutenberg', () => {
    if (!fs.existsSync('webpack.config.gutenberg.js')) {
        return;
    }

    const config = requireNoCache('./webpack.config.gutenberg.js');

    if (!config) {
        return;
    }

    const compiler = webpack(config);

    return gulp.watch(
        `${dist}/app/themes/**/*.{js,ts}`,
        compileOnWatch(compiler)
    );
});

/*
 * Launch browsersync for live reload and browser testing.
 */
gulp.task('browsersync', () => {
    return browserSync({
        files: [
            {
                match: `${dist}/**/*.*`,
            },
        ],
        ignore: stylesAndReload
            ? [`${dist}/app/uploads/*`]
            : [`${dist}/app/uploads/*`, `${dist}/app/themes/**/*.{sass,scss}`],
        watchEvents: ['change', 'add'],
        codeSync: true,
        proxy: process.env.APP_URL,
        snippetOptions: {
            ignorePaths: ['*/wp/wp-admin/**'],
        },
    });
});

/*
 * Watch changes to files, and recompile.
 */
gulp.task(
    'watch',
    gulp.parallel('styles:all:watch', 'scripts:watch:modern', 'scripts:watch:ie', 'scripts:watch:gutenberg', 'browsersync')
);

/*
 * Build the project.
 */
gulp.task('build', gulp.series('iconfont','styles:all', 'styles:fixCss', 'clean-bundles', 'scripts'));

/*
 * Filepack
 */
gulp.task('filepack', () => {
    return gulp
        .src([
            'web/app/**',
            '!web/app/mu-plugins/**',
            '!web/app/mu-plugins',
            'db/db.sql',
            'resources/theme-installation-instructions.pdf',
        ])
        .pipe(zip('filepack.zip'))
        .pipe(gulp.dest(dist));
});

/*
 * WordPress / database tasks
 */
gulp.task('db:export', async (cb) => {
    const exportName = appArguments.file || 'db';
    const removeWp = !!appArguments['no-wp'];
    const replaceWith = appArguments.url || '<-- REPLACE_ADDRESS -->';
    const filePath = `db/${exportName}.sql`;

    await wpcli('db', ['export --skip_comments', filePath]);

    let sqlContent = await readFile(filePath, 'utf8');

    const appUrl = removeWp
        ? `${process.env.APP_URL}(/wp)?`
        : process.env.APP_URL;
    const replace = replaceAddress(appUrl);
    sqlContent = sqlContent.replace(new RegExp(replace, 'g'), replaceWith);

    await writeFile(filePath, sqlContent, 'utf8');

    cb();
});

gulp.task('db:import', (cb) => {
    const fileName = appArguments.file || 'db';
    if (!fs.existsSync(path.resolve(__dirname, `db/${fileName}.sql`))) {
        cb();
        return;
    }

    wpcli('db', ['import', `db/${fileName}.sql`]);

    wpcli('search-replace', [
        '"<-- REPLACE_ADDRESS -->"',
        `"${process.env.APP_URL}"`,
        `--all-tables-with-prefix`,
    ]);

    cb();
});

/*
 * Installation
 */
const installWordpress = (cb) => {
    wpcli('db', ['create']);

    wpcli('core', [
        'install',
        `--url="${process.env.APP_URL}"`,
        `--title="WP Title Example"`,
        '--admin_user=wpdev',
        '--admin_email="example@example.com"',
        '--admin_password="qwe123EWQ#@!"',
    ]);

    wpcli('rewrite', ['flush']);

    cb();
};

gulp.task('wp-install', installWordpress);

/**
 * Flush permalinks
 */
gulp.task('wp-flush', (cb) => {
    wpcli('rewrite', ['flush', '--hard']);

    cb();
});

/**
 * Regenerate thumbnails
 */
gulp.task('wp-regen', (cb) => {
    wpcli('media', ['regenerate', '--yes']);

    cb();
});

gulp.task('install', installWordpress);

/*
 * This runs when you just type "gulp".
 */
gulp.task('default', gulp.series('build', 'watch'));
