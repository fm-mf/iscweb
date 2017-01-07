@extends('layouts.user')

@section('content')
    <h1>Ověření</h1>
    <p>Děkujeme za registraci do Buddy Programu!</p>
    <p>Protože dbáme na bezpečí našich zahraničních studentů, bude teď potřeba ověřit Tvou identitu. <br>
        K ověření je možné použít univerzitní email na ktrerý ti zašleme odkaz pro aktivaci účtu.</p>
    <p>V případě, že nejsi studentem některé z uvedených vysokých škol, nás prosím kontaktuj prostřednictvím formuláře níže, a my se Ti ozveme s dalším postupem.</p>

    {{ Form::open(['url' => '/user/verify']) }}
        {{ Form::bsText('email', 'Email') }}
        {{ Form::bsSubmit('Zaslat ověřovací udaje') }}
    {{ Form::close() }}
@stop