const mix = require("laravel-mix");

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

mix.js("resources/js/publicVue.js", "public/js")
    .js("resources/js/adminVue.js", "public/js")
    .sass("resources/sass/public.scss", "public/css")
    .sass("resources/sass/admin.scss", "public/css");
