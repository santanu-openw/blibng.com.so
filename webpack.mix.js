let mix = require('laravel-mix');
const PathOverridePlugin = require('path-override-webpack-plugin');
const Modules = require('./plugins/plugins.json');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

const APP_NAME = "zixapi";
let aliases = {
    '@zix': path.resolve('./plugins')
};
let plugins = [];

Object.keys(Modules).map(function (module, index) {
    if (Modules[module].status) {
        aliases["@zix-" + module.toLocaleLowerCase()] = path.resolve('./plugins/' + module + '/Assets');
        plugins.push(new PathOverridePlugin(new RegExp('@zix-' + module.toLocaleLowerCase()), path.resolve('./resources/assets/' + APP_NAME + '/' + module.toLocaleLowerCase())));
    }
});


mix.webpackConfig({
    resolve: {
        alias: aliases
    },
    plugins: plugins
});

mix
    .js('resources/assets/admin/main.js', 'public/admin/js/app.js')
    .stylus('resources/assets/admin/main.styl', 'public/admin/css/app.css')
    .js('resources/assets/default/main.js', 'public/default/js/app.js').sourceMaps()
    .stylus('resources/assets/default/main.styl', 'public/default/css/app.css')

    .version();

