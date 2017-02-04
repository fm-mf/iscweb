<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>International Student Club CTU in Prague</title>

    <meta property="og:title" content="International Student Club CTU in Prague">
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://isc.cvut.cz">
    <meta property="og:image" content="http://isc.cvut.cz/img/isc-web.jpg">

    <link rel="shortcut icon" href="/favicon.ico">

    @section('stylesheets')
        <link href="{{ URL::asset('css/web.css') }}" rel="stylesheet" type="text/css">
    @show


    <script type="text/javascript" src="//use.typekit.net/aav2ndi.js"></script>
    <script type="text/javascript">try{ Typekit.load();}catch(e){}</script>
</head>

<body id="page-top">
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-MPBKF8" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){ w[l]=w[l]||[];w[l].push({ 'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-MPBKF8');</script>

@yield('page')

<!------------ FOOTER ---------------- -->
<div class="footer-wrap">
    <div class="container footer">
        <div class="row">
            <div class="col-sm-2">
                <h3>Our projects</h3>
                <span class="bar"></span>
                <ul class="list-unstyled">
                    <li><a href="http://www.integreat.cz" target="_blank"><img src="{{ URL::asset('img/web/integreat_svetle_60x60.png') }}" width="17px"> inteGREAT</a></li>
                    <!-- <li><a href="http://isc.cvut.cz/survivalguide">SURVIVAL GUIDE</a></li> -->
                    <li><a href="http://isc.cvut.cz/saf" target="_blank">Study Abroad Fair</a></li>
                    <li>ISC Care</li>
                </ul>
            </div>
            <div class="col-sm-2">
                <h3>Our channels</h3>
                <span class="bar"></span>
                <ul class="list-unstyled">
                    <li><a href="https://www.facebook.com/isc.ctu.prague" target="_blank"><img src="{{ URL::asset('img/web/fb.png') }}" width="17px"> Facebook</a></li>
                    <li><a href="https://www.linkedin.com/company/1201189" target="_blank"><img src="{{ URL::asset('img/web/in.png') }}" width="17px"> LinkedIn</a></li>
                    <li><a href="http://www.youtube.com/user/ISCCTUPrague" target="_blank"><img src="{{ URL::asset('img/web/youtube.png') }}" width="17px"> YouTube</a></li>
                    <li><a href="http://www.flickr.com/groups/iscctu/" target="_blank">Flickr</a></li>
                </ul>
            </div>
            <div class="col-sm-2">
                <h3>Czech Members</h3>
                <span class="bar"></span>
                <ul class="list-unstyled">
                    <li><a href="{{ url('partak') }}">ParťákNet</a></li>
                    <li><a href="{{ url('muj-buddy') }}">Buddy Program</a></li>
                </ul>
            </div>
            <div class="col-sm-6">
                <p>&copy; {{ \Carbon\Carbon::today()->year }} | International Student Club CTU in Prague, z.s.</p>
            </div>
        </div><!-- /row -->
    </div><!-- /footer -->
</div><!-- /footer-wrap -->

@section('javascript')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="{{ asset('js/guide/bootstrap.min.js') }}"></script>
<script>
    $(document).ready(function() {
        var theLoc = $('.show-menu').position().top;
        $(window).scroll(function() {
            if (theLoc >= $(window).scrollTop()) {
                if ($('.navbar-custom').hasClass('top-nav-collapse')) {
                    $('.navbar-custom').fadeOut(300, function() {
                        $('.navbar-custom').removeClass('top-nav-collapse').show(0);
                    });
                }
            } else {
                if (!$('.navbar-custom').hasClass('top-nav-collapse')) {
                    $('.navbar-custom').hide(0).addClass('top-nav-collapse').fadeIn(600);
                }
            }
        });
    });
</script>
<script>

    $('#scroll').on('click', function(e) {
        e.preventDefault();
        var eventDiv = $("#events");
        var pos = eventDiv.position().top;
        $("html, body").animate({
            scrollTop: pos
        });
        return false;
    });

    $('#about-link').on('click', function(e) {
        e.preventDefault();
        var eventDiv = $("#about-us");
        var pos = eventDiv.position().top;
        $("html, body").animate({
            scrollTop: pos
        });
        return false;
    });

    document.querySelector("#logo").addEventListener('contextmenu', function(event) {
        event.preventDefault();
        $('#logo-download').modal('show')
    }, false);

</script>

@show

</body>
</html>