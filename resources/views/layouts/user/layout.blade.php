<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Buddy Program</title>

    <link rel="icon" type="image/vnd.microsoft.icon" href="{{ asset('img/favicon.ico') }}" sizes="16x16 32x32 64x64" />

    @section('stylesheets')
        <link href="{{ mix('css/user.css') }}" rel="stylesheet" type="text/css">
    @show
</head>
<body>
@include('partials.google-analytics')

@yield('page')

@section('scripts')
    <script src="{{ asset('js/jquery.min.js') }}" defer="defer"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" defer="defer"></script>
    <script src="{{ asset('js/chosen.jquery.min.js') }}" defer="defer"></script>
    <script>
        $(document).ready(function() {
            $(".chosen").chosen();
            $( ".chosen" ).on( "change", function() {
                window.location.replace("{include #link1}/"+$(this).attr("name")+"/"+$(this).val());
            });
        });
    </script>
@show

</body>
</html>
