@extends('czech.layouts.layout')
@section('title', 'Co děláme')
@section('page')
    <section class="container">
        <div class="row">
            <div class="col">
                <h2>Zažij více!</h2>
                <div class="zig-zag">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row align-items-center">
                                <div class="col">
                                    <ul class="list-unstyled">
                                        <li><strong>Zlepši si jazyky</strong></li>
                                        <li>
                                            Vyber si z řady jazykových lekcí vedených rodilými mluvčími zdarma
                                            nebo se přihlaš do intenzivního Tandem programu
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-auto">
                                    <img src="{{ asset('img/logos/isc-logo-watermark-color.svg') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 offset-lg-6">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <img src="{{ asset('img/logos/isc-logo-watermark-color.svg') }}" />
                                </div>
                                <div class="col">
                                    <ul class="list-unstyled">
                                        <li><strong>Buddy program</strong></li>
                                        <li>
                                            Pomoz přijíždějícímu studentovi s jeho prvními dny v Česku
                                            a nauč se na oplátku něco o jeho kultuře
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p>
                    Podívej se, co právě chystáme
                    <a href="{{ url('czech/calendar') }}" class="embed-nav">Kalendář</a>
                </p>
            </div>
        </div>
    </section>
@endsection
