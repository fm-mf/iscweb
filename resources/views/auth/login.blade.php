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
        <div class="err-msgs">
            <p><span class="glyphicon glyphicon-remove-circle"></span></p>
        </div>
        <form role="form" action="{link User:login}" method="post" onsubmit="mhash();">
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="email" value="{{ $email }}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Heslo</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
            </div>
            <input type="hidden" name="hash" value="">
            <button type="submit" class="btn btn-default">Přihlásit</button>
        </form>
        <div class="login-links">
            <p>Ješte nemáš účet? <a href="{{ url('user/regiter') }}">Zaregistruj se</a>!<br>
                <a href="{{ url('User:renewPassword') }}">Zapomněl jsi heslo</a>?
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