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

    <link rel="icon" type="image/vnd.microsoft.icon" href="{{ asset('img/favicon.ico') }}" sizes="16x16 32x32 64x64" />

    @section('stylesheets')
        <link href="{{ URL::asset('css/web.css') }}" rel="stylesheet" type="text/css">
    @show


    <script type="text/javascript" src="//use.typekit.net/aav2ndi.js"></script>
    <script type="text/javascript">try{ Typekit.load();}catch(e){}</script>
    <meta http-equiv="refresh" content="10" >
</head>

<body id="page-top">
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-MPBKF8" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){ w[l]=w[l]||[];w[l].push({ 'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-MPBKF8');</script>

@yield('page')

<!------------ FOOTER ---------------- -->


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