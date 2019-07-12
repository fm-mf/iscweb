<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>International Student Club CTU in Prague</title>
        <meta property="og:title" content="International Student Club CTU in Prague">
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://isc.cvut.cz/czech/">
        <meta property="og:image" content="{{ URL::asset('/img/isc-web.jpg') }}">
        <link rel="icon" type="image/vnd.microsoft.icon" href="{{ asset('img/favicon.ico') }}" sizes="16x16 32x32 64x64"/>
        @section('stylesheets')
            <link href="{{ URL::asset('css/web.css') }}" rel="stylesheet" type="text/css">
            <link href="{{ URL::asset('css/czech.css') }}" rel="stylesheet" type="text/css">
        @show
        <script type="text/javascript" src="https://use.typekit.net/aav2ndi.js"></script>
        <script type="text/javascript">try {
                Typekit.load();
            } catch (e) {
            }</script>
    </head>
    <body id="page-top" class="page-background buddy-program">
        <noscript>
            <iframe src="//www.googletagmanager.com/ns.html?id=GTM-MPBKF8" height="0" width="0" style="display:none;visibility:hidden"></iframe>
        </noscript>
        <script>(function (w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({'gtm.start': new Date().getTime(), event: 'gtm.js'});
                var f = d.getElementsByTagName(s)[0], j = d.createElement(s), dl = (l !== 'dataLayer' ? '&l=' + l : '');
                j.async = true;
                j.src = '//www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', 'GTM-MPBKF8');</script>
        <div class="header-wrapper" >
            @include('czech.layouts.navigation')
        </div>
    @yield('page')

    <!------------ FOOTER ---------------- -->
        <div class="footer-wrap">
            <div class="container footer">
                <div class="row">
                    <!--<div class="col-sm-2">
                        <h3>Na&scaron;e projekty</h3>
                        <span class="bar"></span>
                        <ul class="list-unstyled">
                            <li><a href="https://www.facebook.com/inteGREATParty/" target="_blank">
                                    <img src="{{ URL::asset('img/web/integreat_svetle_60x60.png') }}" width="17"> inteGREAT</a>
                            </li>
                            <li><a href="http://isc.cvut.cz/survivalguide">SURVIVAL GUIDE</a></li>
                            <li>
                                <a href="{{ action('Saf\SafController@showIndex') }}" target="_blank">S ČVUT do světa</a>
                            </li>
                            <li>ISC Care</li>
                        </ul>
                    </div>-->
                    <div class="col-sm-4 col-sm-offset-3">
                        <h3>Soci&aacute;ln&iacute; s&iacute;t&ecaron;</h3>
                        <span class="bar"></span>
                        <ul class="list-unstyled">
                            <li>
                                <a href="https://www.facebook.com/isc.ctu.prague" target="_blank"><img src="{{ URL::asset('img/web/fb.png') }}" width="17"> Facebook</a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/isc.cvut/" target="_blank"><img src="{{ URL::asset('img/web/instagram.png') }}" width="17"> Instagram</a>
                            </li>
                            <li>
                                <a href="https://www.youtube.com/user/ISCCTUPrague" target="_blank"><img src="{{ URL::asset('img/web/youtube.png') }}" width="17"> YouTube</a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/company/1201189" target="_blank"><img src="{{ URL::asset('img/web/in.png') }}" width="17"> LinkedIn</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-4">
                        <h3>Pro st&aacute;l&eacute; n&aacute;v&scaron;t&ecaron;vn&iacute;ky</h3>
                        <span class="bar"></span>
                        <ul class="list-unstyled">
                            <li><a href="{{ action('Partak\DashboardController@index') }}">ParťákNet</a></li>
                            <li>
                                <a href="{{ action('Buddyprogram\ListingController@listExchangeStudents') }}">Buddy Program</a>
                            </li>
                            <li><a href="{{ url('blog') }}">ISC Blog</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12" style="text-align: center">
                        <p><a href="{{ url('/privacy') }}">Privacy policies</a></p>
                        <p>&copy; {{ \Carbon\Carbon::today()->year }} | International Student Club CTU in Prague, z.s.</p>
                    </div>
                </div><!-- /row -->
            </div><!-- /footer -->
        </div><!-- /footer-wrap -->
        @section('javascript')
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <script>
                $(document).ready(function () {
                    $(window).scroll(function () {
                        var navbar_custom = $('.navbar-custom');
                        if ($(window).scrollTop() > 0) {
                            if (!navbar_custom.hasClass('top-nav-collapse')) {
                                navbar_custom.removeClass('nav-bg-fade-out').addClass('top-nav-collapse');
                            }
                        } else {
                            if (navbar_custom.hasClass('top-nav-collapse')) {
                                navbar_custom.removeClass('top-nav-collapse').addClass('nav-bg-fade-out');
                            }
                        }
                    });
                });
            </script>
            <script src="{{ URL::asset('/js/instafeed.min.js') }}"></script>
            <script>
                var feed = new Instafeed({
                    get: 'user',
                    userId: '3020077602',
                    clientId: '723086ddbfd244c5adb1094981fa7cb2',
                {{-- https://elfsight.com/service/generate-instagram-access-token/ --}}
                {{-- clientSecret: 01784b975df94ebe93c194c543217cae --}}
                    accessToken: '3020077602.723086d.866bfcc502904a3387b00bf05070214b',
                    limit: 14,
                    after: function(){$('#instafeed a').attr('target', '_blank')},
                    error: function(){$('#instafeed-container').remove()}
                });
                feed.run();

            </script>
        @show
    </body>
</html>
