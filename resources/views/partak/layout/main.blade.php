<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <meta id="token" name="csrf-token" content="{{csrf_token()}}">
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
</head>

<body>
<div id="wrap">
<!------------------------------ Logo and navigation ----------------------------------->
<nav class="navbar navbar-custom navbar-main top-navigation" role="navigation">
    <div class="container">
        <div class="row">
            <div class="navbar-header col-sm-3">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand partaknet-logo" href="https://isc.cvut.cz">
                    <img src="{{ asset('img/web/logo2.png') }}" style="margin-top: 5px !important;" width="150" id="logo" alt="International Student Club">
                    <!--PartákNET-->
                </a>
            </div><!-- /.navbar-header -->
            <div class="navbar-brand" href="#">ParťákNET</div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse col-sm-9">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li><a href="{{ url('user/logout') }}"><img src="{{ URL::asset( Auth::user()->person->avatar() ) }}" class="img-circle top-navigation-user" />Logout</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.row -->
    </div><!-- /.container -->
    @if(session('AlertMessage'))
        <div class="alert-danger">
            <span class="glyphicon glyphicon-alert" style="padding-right:5px;"></span>{{ session('AlertMessage') }}<br>
        </div>
    @endif
</nav>
@yield('page')

@include('footer')
    <div id="push"></div>
</div>

<div class="footer-wrapper" id="footer">
    <div class="container">
        <div class="row footer">
            <div class="col-sm-12 align-center">
                &copy; International Student Club CTU in Prague, z.s. | za stránku zodpovídá Quality & Knowledge Manager (<a href="mailto:knowledge@isc.cvut.cz">knowledge@isc.cvut.cz</a>)
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.1.0/less.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
@show


</body>
</html>