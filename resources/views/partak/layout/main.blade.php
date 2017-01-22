<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <meta property="og:title" content="">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <link rel="shortcut icon" href="/favicon.ico">

    @section('stylesheets')
        <link href="{{ URL::asset('/css/partaknet.css') }}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    @show


    <script type="text/javascript" src="//use.typekit.net/aav2ndi.js"></script>
    <script type="text/javascript">try{ Typekit.load();}catch(e){}</script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.1.0/less.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
</head>

<body>

@yield('page')

<div class="footer-wrapper">
    <div class="container">
        <div class="row footer">
            <div class="col-sm-12 align-center">
                &copy; International Student Club CTU in Prague, z.s. | za stránku zodpovídá Quality & Knowledge Manager (<a href="mailto:knowledge@isc.cvut.cz">knowledge@isc.cvut.cz</a>)
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
@show


</body>
</html>