@extends('layouts.user')

@section('content')
    <h1>Ověření</h1>
    <p>Děkujeme za registraci do Buddy Programu!</p>
    <p>Protože dbáme na bezpečí našich zahraničních studentů, bude teď potřeba ověřit Tvou identitu. <br>
        K ověření je možné použít univerzitní email na ktrerý ti zašleme odkaz pro aktivaci účtu.</p>
    <p>V případě, že nejsi studentem některé z uvedených vysokých škol, nás prosím kontaktuj prostřednictvím formuláře níže, a my se Ti ozveme s dalším postupem.</p>

    {{ Form::open(['url' => '/user/verify']) }}

    <div class="row">
        <div class="col-sm-12">
            {{ Form::label('email', 'Email', ['class' => 'control-label']) }}
            @if ($errors->has('email'))
                <p class="error-block alert-danger">{{ $errors->first('email') }}</p>
            @endif

            @if ($errors->has('domain'))
                <p class="error-block alert-danger">{{ $errors->first('domain') }}</p>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-6 left">
            {{ Form::text('email', old('email'), ['class' => 'form-control']) }}
        </div>
        <div class="col-sm-1">@</div>
        <div class="col-sm-5 right">
            {{ Form::select('domain', $allowedDomains, old('domain'), ['class' => 'form-control', 'id' => 'select']) }}
        </div>
        <div class="col-sm-6 info"></div>
    </div>

        {{ Form::bsSubmit('Zaslat ověřovací udaje') }}
    {{ Form::close() }}
@stop

@section('stylesheets')
    @parent
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@stop

@section('scripts')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript">
        $('select').select2();
    </script>
@stop