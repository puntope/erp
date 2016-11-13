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

elixir(function(mix) {
    mix.sass('app.scss');

    mix.scripts([
        'vendor/jquery-1.12.0.min.js',
        'vendor/toastr.min.js',
        'vendor/bootstrap.min.js',
        'vendor/vue.min.js',
        'vendor/vue-resource.min.js'
    ],'public/assets/js/vendor.js');

    mix.styles([
        'vendor/bootstrap.min.css',
        'vendor/chosen.min.css',
        'vendor/default.css',
        'vendor/toastr.min.css'
    ],'public/assets/css/vendor.css')
});
