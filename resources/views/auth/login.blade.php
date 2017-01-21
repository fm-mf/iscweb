<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Přihlášení</title>

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link href="{{ URL::asset('css/login.css') }}" rel="stylesheet" type="text/css">

    <link rel="shortcut icon" href="{$basePath}/favicon.ico">

    <script type="text/javascript" src="//use.typekit.net/aav2ndi.js"></script>
    <script type="text/javascript">try{ Typekit.load();}catch(e){}</script>
</head>
<body>
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-MPBKF8" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){ w[l]=w[l]||[];w[l].push({ 'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-MPBKF8');</script>



<div class="login-wrapper">
    <div class="center">
        <blockquote><p>"We can't help everyone, but everyone can help someone."</p><p><small>Ronald Raegan</small></p></blockquote>
        <h1>PŘIHLÁŠENÍ DO BUDDY PROGRAMU</h1>

        @if(count($errors))
        <div class="err-msgs">
            @foreach($errors->all() as $error)
                <p><span class="glyphicon glyphicon-remove-circle"></span>{{ $error }}</p>
            @endforeach
        </div>
        @endif

        {{ Form::open(['url' => '/user']) }}

            {{ Form::bsText('email', 'Email', null, ['placeholder' => 'Email']) }}
            {{ Form::bsPassword('password', 'Heslo', ['placeholder' => 'Heslo']) }}
            {{ Form::bsSubmit('Prihlasit') }}

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