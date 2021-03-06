const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
mix.js('resources/js/admin/admin.js', 'public/js/admin');
mix.js('resources/js/admin/home.js', 'public/js/admin');
mix.js('resources/js/admin/product/index.js', 'public/js/admin/product');
mix.js('resources/js/admin/product/create.js', 'public/js/admin/product');
mix.js('resources/js/admin/product/edit.js', 'public/js/admin/product');
mix.sass('resources/sass/admin.scss', 'public/css');
