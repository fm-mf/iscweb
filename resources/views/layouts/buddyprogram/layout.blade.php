<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta id="token" name="csrf-token" content="{{csrf_token()}}">

    <title>Buddy Program</title>

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>

    @section('stylesheets')
        <link href="{{ asset('css/buddyprogram.css') }}" rel="stylesheet" type="text/css">
    @show

    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">

    <script type="text/javascript" src="//use.typekit.net/aav2ndi.js"></script>
    <script type="text/javascript">try{ Typekit.load();}catch(e){}</script>
</head>
<body>
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-MPBKF8" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){ w[l]=w[l]||[];w[l].push({ 'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-MPBKF8');</script>

<div class="site-wrapper">
    @if(false)
    <div class="menu">
        <ul class="nav nav-stacked">
            <li><a href="{{ action('Buddyprogram\ListingController@listExchangeStudents') }}"><img src="{{ URL::asset('buddyprogram/img/users.png') }}"><br>VOLNÍ STUDENTI</a></li>
            <li><a href="{{ action('Buddyprogram\ListingController@listExchangeStudents') }}"><img src="{{ URL::asset('buddyprogram/img/user.png') }}"><br>MOJÍ STUDENTI</a></li>
            <!--<li><a n:href="Homepage:arrivals"><img src="{$basePath}/img/arrivals.png"><br>PŘÍJEZDY</a></li>-->
            <!--<li><a href="#"><img src="{$basePath}/img/settings.png"><br>MŮJ ÚČET</a></li>-->
            <li class="logout"><a href="{{ url('user/logout') }}"><img src="{{ URL::asset('buddyprogram/img/log-out.png') }}"><br>ODHLÁSIT</a></li>
        </ul>
    </div>
    @endif

    @yield('content')

</div>

@section('scripts')
    <script
            src="https://code.jquery.com/jquery-3.1.1.js"
            integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
            crossorigin="anonymous"></script>
    <script src="{{ asset('js/chosen.jquery.min.js') }}"></script>
    <script>
        $(".chosen").chosen();

        $(document).ready(function() {
            $( ".chosen" ).on( "change", function() {
                window.location.replace("{include #link1}/"+$(this).attr("name")+"/"+$(this).val());
            });
        });
    </script>
@show
</body>
</html>