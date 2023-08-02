let mix = require('laravel-mix');

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
   .sass('resources/sass/app.scss', 'public/css')
   .sass('resources/sass/dashboard.scss', 'public/css')
   .copy('resources/img/profile.png', 'public/storage/img/profile.png')
   .copy('node_modules/@fortawesome/fontawesome-free/webfonts/fa-brands-400.ttf', 'public/webfonts/')
   .copy('node_modules/@fortawesome/fontawesome-free/webfonts/fa-brands-400.woff2', 'public/webfonts/')
   .copy('node_modules/@fortawesome/fontawesome-free/webfonts/fa-solid-900.ttf', 'public/webfonts/')
   .copy('node_modules/@fortawesome/fontawesome-free/webfonts/fa-solid-900.woff2', 'public/webfonts/')
   .copy('node_modules/@fortawesome/fontawesome-free/css/fontawesome.css', 'public/css/')
   .copy('node_modules/@fortawesome/fontawesome-free/css/fontawesome.min.css', 'public/css/')
   .copy('node_modules/@fortawesome/fontawesome-free/css/brands.css', 'public/css/')
   .copy('node_modules/@fortawesome/fontawesome-free/css/brands.min.css', 'public/css/')
   .copy('node_modules/@fortawesome/fontawesome-free/css/solid.css', 'public/css/')
   .copy('node_modules/@fortawesome/fontawesome-free/css/solid.min.css', 'public/css/')
   .copy('node_modules/@fortawesome/fontawesome-free/css/svg-with-js.css', 'public/css/')
   .copy('node_modules/@fortawesome/fontawesome-free/css/svg-with-js.min.css', 'public/css/');
