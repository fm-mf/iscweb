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

mix
  .vue({ version: 2 })
  .js('resources/assets/js/web.js', 'public/js')
  .js('resources/assets/js/exchange-students-list.js', 'public/js')
  .js('resources/assets/js/partak.js', 'public/js')
  .js('resources/assets/js/reservation.js', 'public/js')
  .js('resources/assets/js/partak-stats.js', 'public/js')
  .js('resources/assets/js/partak-settings-hours.js', 'public/js')
  .js('resources/assets/js/saf/saf.js', 'public/js/saf')
  .js('resources/assets/js/tandem.js', 'public/js')
  .js('resources/assets/js/ow-trips-stats.js', 'public/js')
  .js('resources/assets/js/blog-rss-feed.js', 'public/js')
  .js('resources/assets/js/printer.js', 'public/js')
  .js('resources/assets/js/pickers.js', 'public/js')
  .js('resources/assets/js/text-editor.js', 'public/js')
  .js('resources/assets/js/crop-avatar.js', 'public/js')
  .js('resources/assets/js/profile.js', 'public/js')
  .sass('resources/assets/sass/web/web.scss', 'public/css')
  .sass('resources/assets/sass/czech/czech.scss', 'public/css')
  .sass('resources/assets/sass/czech/alumni.scss', 'public/css')
  .sass('resources/assets/sass/auth/user.scss', 'public/css')
  .sass('resources/assets/sass/auth/login.scss', 'public/css')
  .sass('resources/assets/sass/partak/partaknet.scss', 'public/css')
  .sass('resources/assets/sass/partak/pdf.scss', 'public/css')
  .sass('resources/assets/sass/picker/picker.scss', 'public/css')
  .sass('resources/assets/sass/buddyprogram/buddyprogram.scss', 'public/css')
  .sass('resources/assets/sass/errors.scss', 'public/css')
  .sass('resources/assets/sass/saf/saf.scss', 'public/css')
  .sass('resources/assets/sass/saf/saf-partner.scss', 'public/css')
  .sass('resources/assets/sass/tandem/tandem.scss', 'public/css')
  .sass('resources/assets/sass/form/form.scss', 'public/css')
  .sass('resources/assets/sass/components/avatar.scss', 'public/css')
  .sass('resources/assets/sass/vendor.scss', 'public/css')
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
  .copy(
    'node_modules/bootstrap-sass/assets/javascripts/bootstrap.js',
    'public/js'
  )
  .copy(
    'node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js',
    'public/js'
  )
  .options({
    processCssUrls: false
  });

if (!mix.inProduction()) {
  mix.sourceMaps();
}
