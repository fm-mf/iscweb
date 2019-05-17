@extends('czech.layouts.layout')
@section('page')
    <div class="container section">
        <div class="row">
            <h1 class="introduction clearfix">Kdo jsme?</h1>
            <p>
                International Student Club je skupinou mladých a aktivních lidí, kteří ve svém volném čase chtějí dělat něco smysluplného a při tom se rádi baví. Každý semestr integrujeme zahraniční studenty do života a dění na naší univerzitě i v celé ČR. Zároveň se od nich sami učíme a zjišťujeme, jak to chodí v ostatních koutech světa.
                Zábavným způsobem tak poznáváme jiné kultury a získáváme spoustu skvělých příležitostí seberealizace, podporujeme aktivní zapojení našich členů a jejich osobní rozvoj.
            </p>
            Chce&scaron; v&ecaron;d&ecaron;t v&iacute;ce?
            <a href="{{ url('/czech/about-us/') }}" class="embed-nav">O N&Aacute;S</a>
            <br>
            <a href="http://www.esn.org" class="logo"><img src="{{ URL::asset('img/web/logo-esn.png') }}"></a>
            <a href="http://www.cvut.cz" class="logo"><img src="{{ URL::asset('img/web/logo-ctu.png') }}"></a>
        </div>
    </div>
    <div class="container section">
        <div class="row">
            <h1 class="introduction clearfix">Za&zcaron;ij v&iacute;ce!</h1>
            <table class="zig-zag">
                <tr>
                    <td>
                        <ul>
                            <li>Zlep&scaron;i si jazyky</li>
                            <li>
                                <small>asdasda</small>
                            </li>
                        </ul>
                        <img src="{{ URL::asset('/img/web/logo-circle.png') }}">
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <img src="{{ URL::asset('/img/web/logo-circle.png') }}">
                        <ul>
                            <li>Buddy program</li>
                            <li>
                                <small>Sd&iacute;len&iacute; &ccaron;esk&eacute; kultury &amp; mezin&aacute;rodn&iacute; p&rcaron;&aacute;telstv&iacute;</small>
                            </li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td>
                        <ul>
                            <li>Cestuj s n&aacute;mi</li>
                            <li>
                                <small>asdasda</small>
                            </li>
                        </ul>
                        <img src="{{ URL::asset('/img/web/logo-circle.png') }}">
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <img src="{{ URL::asset('/img/web/logo-circle.png') }}">
                        <ul>
                            <li>Organizuj men&scaron;&iacute; akce</li>
                            <li>
                                <small>asdasda</small>
                            </li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td>
                        <ul>
                            <li>P&aacute;rty</li>
                            <li>
                                <small>asdasda</small>
                            </li>
                        </ul>
                        <img src="{{ URL::asset('/img/web/logo-circle.png') }}">
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <img src="{{ URL::asset('/img/web/logo-circle.png') }}">
                        <ul>
                            <li>Workshopy</li>
                            <li>
                                <small>asdasda</small>
                            </li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td>
                        <ul>
                            <li>Programuj a hraj</li>
                            <li>
                                <small>Tvorba webov&yacute;ch str&aacute;nek a LAN p&aacute;rty</small>
                            </li>
                        </ul>
                        <img src="{{ URL::asset('/img/web/logo-circle.png') }}">
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <img src="{{ URL::asset('/img/web/logo-circle.png') }}">
                        <ul>
                            <li>Sportuj</li>
                            <li>
                                <small>asdasda</small>
                            </li>
                        </ul>
                    </td>
                </tr>
            </table>
            <br>
            Pod&iacute;vej se, co pr&aacute;v&ecaron; chyst&aacute;me
            <a href="{{ url('/czech/calendar/') }}" class="embed-nav">KALEND&Aacute;&Rcaron;</a>
        </div>
    </div>
    <div id="instafeed-container" class="container section">
        <div class="row">
            <h1 class="introduction clearfix">INSTAFEED</h1>
            <div id="instafeed"></div>
        </div>
    </div>
    <div class="container section">
        <div class="row">
            <h1 class="introduction clearfix">FAQ</h1>
            <div class="faq">
                <ul>
                    <li>Jsem debil?</li>
                    <li>Ano, jsi</li>
                </ul>
                <ul>
                    <li>Co kdy&zcaron; m&aacute;m dal&scaron;&iacute; dotazy?</li>
                    <li>Napi&scaron;te n&aacute;m na
                        <a href="mailto:isc@isc.cvut.cz">isc@isc.cvut.cz</a> nebo n&ecaron;kter&eacute;mu z na&scaron;ich koordin&aacute;tor&uring;
                        <a href="{{ url('/czech/contacts/') }}" class="embed-nav">KONTAKTY</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
