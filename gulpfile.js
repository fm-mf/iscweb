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
    mix.sass('web/web.scss', 'public/css/web.css')
        .sass('auth/user.scss', 'public/css/user.css')
        .sass('partak/partaknet.scss', 'public/css/partaknet.css')
        .sass('auth/login.scss', 'public/css/login.css')
        .sass('picker/picker.scss', 'public/css/picker.css')
        .sass('buddyprogram/buddyprogram.scss', 'public/css/buddyprogram.css')
        .sass('guide/guide.scss', 'public/css/guide.css')
        .sass('guide/guide_subpage.scss', 'public/css/guide_subpage.css')
        .sass('web/buddy.scss', 'public/css/buddy.css')
        .sass('partak/pdf.scss', 'public/css/pdf.css')
        .sass('guide/guide.scss', 'public/css/guide.css')
        .sass('web/buddy.scss', 'public/css/buddy.css')
        .sass('errors.scss', 'public/css/errors.css')
        .sass('saf/saf.scss', 'public/css/saf.css')
        .sass('saf/saf-partner.scss', 'public/css/saf-partner.css')
        .webpack('echangestudentslist.js')
        .webpack('partak.js');
});
