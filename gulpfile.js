var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

const pathes = {
    bootstrap: 'node_modules/bootstrap-sass/assets/',
    fontawesome: 'node_modules/font-awesome/',
    jquery: 'node_modules/jquery/dist/',
    salvattore: 'node_modules/salvattore/dist/'
};

const fonts = [
    pathes.bootstrap + 'fonts/bootstrap',
    pathes.fontawesome + 'fonts'
];

const javascripts = [
    pathes.jquery + 'jquery.js',
    pathes.bootstrap + 'javascripts/bootstrap.js',
    pathes.salvattore + 'salvattore.js'
];

elixir(function(mix) {
    for (var i in fonts) {
        mix.copy(fonts[i], 'public/fonts', './');
    }
    mix.sass('vendor.scss');
    mix.scripts(javascripts, 'public/js/vendor.js', './');
    mix.sass('app.scss');
    mix.browserify('main.js');
});
