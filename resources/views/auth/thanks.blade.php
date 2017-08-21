@extends('layouts.user.layout')

@section('page')
<div class="register-wrapper">
        <div class="left-column"></div>
        <div class="container-thanks">
            <img src="{{ URL::asset('img/web/logo.png') }}" alt="International Student Club" class="logo">
            <h1>Děkujeme za registraci do Buddy Programu!</h1>
            @if (!$verified)
                <p>Děkujeme za odpověď. Brzy se Ti ozveme. Zatím se můžeš kouknout na chystané akce, kde tě rádi uvidíme!</p>
                <p>Vše najdeš na <a href="{{ url('/calendar') }}"> {{ url('/calendar') }} </a></p>
            @else
                <p>Ověření bylo úspěšné.</p>
                <p>Nyní už si můžeš vybrat svého buddyho. Přejeme ti spoustu zábavy!</p>
                <p>Do databáze se dostaneš přes odkaz <a href="{{ url('/muj-buddy') }}">{{ url('/muj-buddy') }}</a></p>
            @endif
            <p>
                Jestli máš chvíli, tak oceníme, když vyplníš tento krátký anonymní formulář.<br>
                Díky!
            </p>

            <!-- Change the width and height values to suit you best -->
            <div class="typeform-widget" data-url="https://iscctu.typeform.com/to/c2edVv" data-text="Buddy Registration" style="width:100%;height:500px;"></div>

            <div style="font-family: Sans-Serif;font-size: 12px;color: #999;opacity: 0.5; padding-top: 5px;">Powered by<a href="https://www.typeform.com/examples/?utm_campaign=c2edVv&amp;utm_source=typeform.com-58650-Basic&amp;utm_medium=typeform&amp;utm_content=typeform-embedded-poweredbytypeform&amp;utm_term=CS" style="color: #999" target="_blank">Typeform</a></div>
        </div>
</div>
@stop

@section('scripts')
    @parent
    <script>
        (function(){ var qs,js,q,s,d=document,gi=d.getElementById,ce=d.createElement,gt=d.getElementsByTagName,id='typef_orm', b='https://s3-eu-west-1.amazonaws.com/share.typeform.com/';if(!gi.call(d,id)){ js=ce.call(d,'script');js.id=id;js.src=b+'widget.js';q=gt.call(d,'script')[0];q.parentNode.insertBefore(js,q) } })()
    </script>
@stop