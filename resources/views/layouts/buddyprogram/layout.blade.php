<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta id="token" name="csrf-token" content="{{csrf_token()}}">

    <title>Buddy Program | ISC CTU in Prague</title>

    <link rel="icon" type="image/vnd.microsoft.icon" href="{{ asset('img/favicon.ico') }}" sizes="16x16 32x32 64x64" />

    <script src="https://kit.fontawesome.com/ff34153e60.js"></script>
    @section('stylesheets')
        <link href="{{ asset('css/buddyprogram.css') }}" rel="stylesheet" type="text/css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    @show

{{-- We do not use Proxima Nova or Myriad Pro fonts from Typekit anymore
    <script type="text/javascript" src="//use.typekit.net/aav2ndi.js"></script>
    <script type="text/javascript">try{ Typekit.load();}catch(e){}</script>--}}
</head>
<body>
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-MPBKF8" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){ w[l]=w[l]||[];w[l].push({ 'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-MPBKF8');</script>

<!-- example 7 - center on mobile 2-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="d-flex flex-grow-1">
        <span class="w-100 d-lg-none d-block"><!-- hidden spacer to center brand on mobile --></span>
        <a class="navbar-brand" href="{{route('buddy-home')}}">
            <img src="{{ URL::asset('/img/web/logo.png') }}"  alt="International Student Club">
        </a>
        <div class="w-100 text-right">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
    <div class="collapse navbar-collapse flex-grow-1 " id="navbar">
        <ul class="navbar-nav ml-auto flex-nowrap">
            <li class="nav-item">
                <a class="nav-link" href="{{ action('Buddyprogram\ListingController@listExchangeStudents') }}">
                    <i class="fas fa-users"></i> Volní studenti
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ action('Buddyprogram\ListingController@listMyStudents') }}">
                    <i class="fas fa-user-friends"></i> Moji studenti
                </a>
            </li>
            {{--<li><a n:href="Homepage:arrivals"><img src="{$basePath}/img/arrivals.png"><br>PŘÍJEZDY</a></li>--}}
            <li class="nav-item">
                <a class="nav-link" href="{{ action('Auth\ProfileController@showProfileForm') }}">
                    <i class="fas fa-user"></i> Můj profil
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ action('Auth\LoginController@logout') }}">
                    <i class="fas fa-sign-out-alt"></i> Odhlásit se
                </a>
            </li>
        </ul>
    </div>
</nav>

<main class="container-fluid">
    @yield('content')
</main>

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"  crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
@show
</body>
</html>