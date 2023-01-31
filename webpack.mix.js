const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
| for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.vue({ version: 2 })
    .js('resources/js/web.js', 'public/js')
    .js('resources/js/exchange-students-list.js', 'public/js')
    .js('resources/js/partak.js', 'public/js')
    .js('resources/js/reservation.js', 'public/js')
    .js('resources/js/partak-stats.js', 'public/js')
    .js('resources/js/partak-settings-hours.js', 'public/js')
    .js('resources/js/tandem.js', 'public/js')
    .js('resources/js/ow-trips-stats.js', 'public/js')
    .js('resources/js/blog-rss-feed.js', 'public/js')
    .js('resources/js/printer.js', 'public/js')
    .js('resources/js/pickers.js', 'public/js')
    .js('resources/js/text-editor.js', 'public/js')
    .js('resources/js/crop-avatar.js', 'public/js')
    .js('resources/js/profile.js', 'public/js')
    .sass('resources/sass/auth.scss', 'public/css')
    .sass('resources/sass/web/web.scss', 'public/css')
    .sass('resources/sass/guide/guide.scss', 'public/css')
    .sass('resources/sass/czech/czech.scss', 'public/css')
    .sass('resources/sass/czech/alumni.scss', 'public/css')
    .sass('resources/sass/auth/login.scss', 'public/css')
    .sass('resources/sass/partak/partaknet.scss', 'public/css')
    .sass('resources/sass/partak/pdf.scss', 'public/css')
    .sass('resources/sass/partak/esn-card-labels-pdf.scss', 'public/css')
    .sass('resources/sass/picker/picker.scss', 'public/css')
    .sass('resources/sass/buddyprogram/buddyprogram.scss', 'public/css')
    .sass('resources/sass/errors.scss', 'public/css')
    .sass('resources/sass/tandem/tandem.scss', 'public/css')
    .sass('resources/sass/form/form.scss', 'public/css')
    .sass('resources/sass/components/avatar.scss', 'public/css')
    .sass('resources/sass/exchange-profile.scss', 'public/css')
    .sass('resources/sass/general.scss', 'public/css')
    .sass('resources/sass/vendor.scss', 'public/css')
    .copy(
        'node_modules/@fortawesome/fontawesome-free/webfonts/*',
        'public/fonts/font-awesome'
    )
    .copy('node_modules/cropperjs/src/images/*', 'public/img/cropper')
    .copy('node_modules/jquery/dist/jquery.min.js', 'public/js')
    .copy('node_modules/jquery/dist/jquery.slim.min.js', 'public/js')
    .copy('node_modules/popper.js/dist/umd/popper.min.js', 'public/js')
    .copy(
        'node_modules/bootstrap/dist/js/bootstrap.min.js',
        'public/js/bootstrap.4.min.js'
    )
    .options({
        processCssUrls: false
    });

if (!mix.inProduction()) {
    mix.sourceMaps();
} else {
    mix.version();
}
