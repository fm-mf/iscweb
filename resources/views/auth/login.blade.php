<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Přihlášení</title>

    <link rel="icon" type="image/vnd.microsoft.icon" href="{{ asset('img/favicon.ico') }}" sizes="16x16 32x32 64x64" />

    <link href="{{ URL::asset('css/login.css') }}" rel="stylesheet" type="text/css">

{{-- We do not use Proxima Nova or Myriad Pro fonts from Typekit anymore
    <script type="text/javascript" src="//use.typekit.net/aav2ndi.js"></script>
    <script type="text/javascript">try{ Typekit.load();}catch(e){}</script>--}}
</head>
<body>
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-MPBKF8" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){ w[l]=w[l]||[];w[l].push({ 'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-MPBKF8');</script>



<div class="login-wrapper">
    <div class="center">
        <blockquote><p>"We can't help everyone, but everyone can help someone."</p><p><small>Ronald Raegan</small></p></blockquote>
        @if(str_contains(Session::get('url.intended', action('Buddyprogram\ListingController@listExchangeStudents')), action('Partak\DashboardController@index')))
            <h1>Přihlášení na ParťákNET</h1>
        @else
            <h1>PŘIHLÁŠENÍ DO BUDDY PROGRAMU</h1>
        @endif


        @if(count($errors))
        <div class="err-msgs">
            @foreach($errors->all() as $error)
                <p><span class="glyphicon glyphicon-remove-circle"></span>{{ $error }}</p>
            @endforeach
        </div>
        @endif

        {{ Form::open(['url' => '/user']) }}

            {{ Form::bsText('email', 'E-mail', '', null, ['placeholder' => 'E-mail']) }}
            {{ Form::bsPassword('password', 'Heslo', ['placeholder' => 'Heslo']) }}
            {{ Form::bsSubmit('Přihlásit') }}

        {{ Form::close() }}

        <div class="login-links">
            <p>Ješte nemáš účet? <a href="{{ url('user/register') }}">Zaregistruj se</a>!<br>
                <a href="{{ url('user/password') }}">Zapomněl jsi heslo</a>?
            </p>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
    $(".chosen").chosen();

    $(document).ready(function() {
        $( ".chosen" ).on( "change", function() {
            window.location.replace("{include #link1}/"+$(this).attr("name")+"/"+$(this).val());
        });
    });
</script>

</body>
</html>
