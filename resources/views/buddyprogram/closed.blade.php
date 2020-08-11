@extends('layouts.buddyprogram.layout')

@section('content')
    <div class="container page">
        <h2 class="text-center">Databáze zahraničních studentů ještě nebyla otevřena. Buddy Program pro zimní semestr 2020/2021 bude spuštěn 25. srpna 2020.</h2>
        <p class="text-center">Pro více informací sleduj naší Facebookovou skupinu <a href="{{ $fbGroupCzechBuddies }}" target="_blank" rel="noopener">ISC CTU Czech Buddies</a>
         a také naší Facebookovou stránku <a href="{{ $fbPageUrl }}" target="_blank" rel="noopener">ISC CTU in Prague</a>.</p>
        <div class="col">
            <img src="{{ asset('img/buddyprogram/buddy-databaze-mapa-fall2020.jpg') }}" style="width: 100%" alt="@lang('buddy-program.world-map-alt')" />
        </div>
    </div>
@stop
