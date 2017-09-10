<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>@yield('title')Survival Guide | {{ $shortName }}</title>

        <link rel="icon" type="image/vnd.microsoft.icon" href="{{ asset('img/favicon.ico') }}" sizes="16x16 32x32 64x64" />
        <link rel="stylesheet" href="{{ asset('css/guide_subpage.css') }}" />

        <script type="text/javascript" src="https://use.typekit.net/aav2ndi.js"></script>
        <script type="text/javascript">
            try {
                Typekit.load();
            } catch (e) {
            }
        </script>
    </head>
    <body>
        <div id="primaryContainer" class="primaryContainer">
            @include('layouts.guide.navigation')
            <div id="page">
                <div class="container page-container">

                    {{-- @include('layouts.guide.header') --}}
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