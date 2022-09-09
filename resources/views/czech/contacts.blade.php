@extends('czech.layouts.layout')

@section('title', 'Kontakty')

@section('header')
    <div class="header-wrapper contacts-header">
        <header>
            @include('czech.layouts.navigation')
            <div id="map-preview-wrapper">
                <div id="map-preview"></div>
                <div class="container">
                    <div class="row d-sm-none">
                        <div class="col-auto mx-auto mt-4">
                            <a href="https://goo.gl/maps/XbXLrMvPw62JSuzH6" target="_blank" rel="noopener" class="btn btn-primary">Najděte nás na Mapách Google</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8 col-md-6 col-lg-4 ml-auto">
                            <div class="row">
                                <div class="col opening-hours">
                                    <h2>Otvírací hodiny</h2>
                                    {{ $openingHours->html_text }}
                                    @component('web.components.opening-hours-table', ['openingHours' => $openingHours->hours_json['hours']])
                                    @endcomponent
                                </div>
                            </div>
                            <div class="row">
                                <div class="col address">
                                    <h2>Kde nás najdete?</h2>
                                    <ol class="list-unstyled">
                                        <li class="font-weight-bold">{{ $fullName }}</li>
                                        <li>Masarykova kolej, místnost 304 (červená)</li>
                                        <li><address>Thákurova 550/1, Praha 6 – Dejvice</address></li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>
@endsection

@section('page')
    <section class="p-0"></section>
    <section class="our-contacts">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2>Kontaktní údaje</h2>
                </div>
            </div>
            <dl class="row justify-content-center">
                <div class="col-md-6 col-xl-4 d-flex">
                    <dt><span class="fa-brands fa-instagram"></span> Instagram</dt>
                    <dd><a href="{{ $igProfileUrl }}" target="_blank" rel="noopener">@isc.ctu</a></dd>
                </div>
                <div class="col-md-6 col-xl-4 d-flex">
                    <dt><span class="fa-brands fa-facebook"></span> Facebook</dt>
                    <dd><a href="{{ $fbPageUrl }}" target="_blank" rel="noopener">isc.ctu.prague</a></dd>
                </div>
                <div class="col-md-6 col-xl-4 d-flex">
                    <dt><span class="fa-brands fa-discord"></span> Discord</dt>
                    <dd><a href="{{ $buddyDiscordLink }}" target="_blank" rel="noopener">ISC CTU in Prague</a></dd>
                </div>
                <div class="col-md-6 col-xl-4 d-flex">
                    <dt><span class="fas fa-envelope"></span> @lang('web.Email')</dt>
                    <dd><a href="mailto:isc@isc.cvut.cz">isc@isc.cvut.cz</a></dd>
                </div>
                <div class="col-md-6 col-xl-4 d-flex">
                    <dt><span class="fas fa-phone-alt"></span> @lang('web.Phone')</dt>
                    <dd><a href="tel:{{ $pointPhoneNo }}">{{ $pointPhoneNoFormatted }}</a></dd>
                </div>
            </dl>
        </div>
    </section>
    <section class="coordinators">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2>Naši koordinátoři</h2>
                </div>
            </div>
            <ul class="row contacts list-unstyled">
                @foreach($contacts as $contact)
                    <li class="col-sm-9 mx-auto col-md-6 col-xl-4">
                        @include('partials.contact', compact('contact'))
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Fakturační adresa</h2>
                </div>
            </div>
            <div class="row">
                <ol class="col-auto mx-auto list-unstyled billing-info">
                    <li class="font-weight-bold">{{ $officialName }}</li>
                    <li><address>Thákurova 550/1, 160 00, Praha 6 – Dejvice</address></li>
                    <li>IČO: 228 41 032</li>
                </ol>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9ZNFKyW2aiHfQNqt0mv79uHOvUt92gxU" defer="defer"></script>
    @parent
@endsection
