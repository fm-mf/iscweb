const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    mix.sass('web/web.scss', 'public/css/web.css').sass('auth/user.scss', 'public/css/user.css')
    .sass('partak/partaknet.scss', 'public/css/partaknet.css').sass('auth/login.scss', 'public/css/login.css')
       .webpack('app.js');
});
