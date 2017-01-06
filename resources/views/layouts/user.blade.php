<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Buddy Program</title>

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>

    @section('stylesheets')
        <link href="{{ URL::asset('css/user.css') }}" rel="stylesheet" type="text/css">
    @show

    <link rel="shortcut icon" href="{{ URL::asset('favicon.ico') }}">

    <script type="text/javascript" src="//use.typekit.net/aav2ndi.js"></script>
    <script type="text/javascript">try{ Typekit.load();}catch(e){}</script>
</head>
<body>
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-MPBKF8" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){ w[l]=w[l]||[];w[l].push({ 'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-MPBKF8');</script>


<div class="register-wrapper">
    <div class="left-column"></div>
    <div class="form-wrapper container container-form">
        <img src="{{ URL::asset('user/img/logo-reg.png') }}" als="International Student Club" class="logo">
        @yield('content')
    </div>
</div>


@section('javascript')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="j{{ URL::asset('s/chosen.jquery.min.js') }}"></script>
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
