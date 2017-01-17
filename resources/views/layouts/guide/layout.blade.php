<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="{{ asset('css/guide.css') }}">

    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0">

    <title>Survival Guide</title>
    <script type="text/javascript" src="//use.typekit.net/aav2ndi.js"></script>
    <script type="text/javascript">try {
            Typekit.load();
        } catch (e) {
        }</script>
</head>
<body>

<div id="primaryContainer" class="primaryContainer">
    @include('layouts.guide.navigation')
    <div id="page">
        <div class="container page-container">

            @include('layouts.guide.header')
            @section('content')
                @show

        </div><!-- /page-container -->
        @include('layouts.guide.footer')
    </div><!-- /#page --->
</div><!-- /primary container -->

<!-- JavaScript files -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="{{ asset('js/guide/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/guide/menu.js') }}"></script>
</body>
</html>