@extends('czech.layouts.layout')
@section('title', 'Jazyky – Co děláme')

@section('page')
    @include('czech.partials.activities-header')
    @include('czech.partials.activities-menu')
    <section class="activities-detail">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h2>Jazykové kurzy</h2>
                    <p>
                        Chceš si zlepšit cizí jazyky nebo učit svůj rodný jazyk?
                    </p>
                    <p>
                        Využij našich bezplatných jazykových kurzů! Kurzy jsou vyučovány našimi
                        výměnnými studenty z celého světa, českými studenty i cizinci dlouhodobě
                        žijícími v Praze. Kurzy jsou <strong>zdarma</strong>, jsou vedeny
                        zábavnou formou a není na ně potřeba žádné registrace.
                    </p>
                    <p>
                        Jazykové kurzy pro zimní semestr 2024/2025 začínají v <strong>pondělí 7. října 2024</strong>.
                        Rozvrh kurzů bude zveřejněn o týden dříve.
                    </p>
                    <p>
                        <a class="btn btn-primary" href="{{ url('files/languages-schedule.php') }}">
                            Podívejte se na <strong>rozvrh pro zimní semestr 2024/2025</strong>
                        </a>
                    </p>
                    <h3>Kde najdu učebny?</h3>
                    <dl class="room-location">
                        <dt>B305</dt>
                        <dd>
                            se nachází ve 3. patře v červené chodbě na
                            <a href="https://goo.gl/maps/au5lF" target="_blank" rel="noopener">Masarykově koleji</a>,
                            vedle ESN Pointu.
                        </dd>
                        <dt>R404</dt>
                        <dd>
                            se nachází ve 3. patře v červené chodbě na
                            <a href="https://goo.gl/maps/au5lF" target="_blank" rel="noopener">Masarykově koleji</a>,
                            přímo nad ESN Pointem.
                        </dd>
                        <dt>Strahovská učebna</dt>
                        <dd>
                            je ve druhém mezipatře na
                            <a href="https://goo.gl/maps/Vy0nZ" target="_blank" rel="noopener">bloku 8</a>.
                        </dd>
                    </dl>

                    <h2>Tandem</h2>
                    <p>
                        Tandem je způsob vzájemného učení se jazyků. Zjednodušeně, najdeš si partnera, který tě naučí jeho jazyk
                        a ty ho na oplátku naučíš ten svůj.
                    </p>
                    <p>
                        Hlavní výhodou Tandemu je, že to budete jen vy dva, kdo budete určovat čas a intenzitu výuky.
                        Můžeš si samozřejmě najít více Tandem partnerů, pro stejné i různé jazyky.
                    </p>
                    <p>
                        Zaregistruj se do <a href="{{ url('tandem') }}">Tandem databáze</a> a najdi si svého Tandem partnera!
                    </p>
                    {{--<p>
                        Zastav se také na <strong>Tandem eveningu v pondělí 14. září</strong> v klubu Storm!
                        Pro více informací sleduj
                        <a href="https://www.facebook.com/events/345928639923952/" target="_blank" rel="noopener">Facebookovou událos</a>.
                    </p>--}}
                    <p>
                        <a href="{{ url('/tandem') }}" class="btn btn-primary">
                            <span class="fas fa-sign-in-alt"></span> Tandem databáze
                        </a>
                    </p>

                  <h2>Café Lingea</h2>
                    <p>
                        Café Lingea je akce, při které se sejdeme a povídáme si v různých jazycích (obvykle anglicky
                        + v nějakém dalším zvoleném jazyce). Café Lingea probíhá nejčastěji v různých kavárnách,
                        případně v restauracích, takže je to také skvělý způsob, jak v Praze poznat nová místa.
                    {{--                        Připoj se do Facebookové skupiny
                                            <a href="https://www.facebook.com/groups/125659680939345" target="_blank" rel="noopener">ESN Café Lingea</a>!
                                        </p>
                                        <p>Café Lingey se konají každé dva týdny!</p>--}}

                    {{---------------- rozvrh languages eventů ----------------}}
                    @if(isset($langEvents) && $langEvents->count() > 0)
                        <h3>Přehled akcí v semestru {{ $currentSemester }}</h3>
                        <table class="presentations-list">
                            <thead>
                            <tr>
                                <th>Akce</th>
                                <th>Datum</th>
                                <th>Čas</th>
                                <th>Kde</th>
                                <th>Více informací</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($langEvents as $langEvent)
                                <tr>
                                    <td>{{ $langEvent->event->name }}</td>
                                    <td>{{ $langEvent->event->datetime_from->format('l, j. F') }}</td>
                                    <td>{{ $langEvent->event->getTimeFormatted() }}</td>
                                    <td><a {{  isset($langEvent->where_url)? 'href='.$langEvent->where_url : ''  }} target="_blank">{{ $langEvent->where }}</a></td>
                                    <td><a {!! isset($langEvent->event->facebook_url)? 'href='.$langEvent->event->facebook_url : ''  !!} target="_blank">Facebooková událost</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                <div class="col-md-4 schedule">
                    <h2>Rozvrh jazykových kurzů</h2>
                    <p>
                        Podívejte se na rozvrh ESN jazykových kurzů pro
                        <a href="{{ url('files/languages-schedule.php') }}" target="_blank">
                            zimní semestr 2024/2025
                        </a>.
                    </p>{{--
                    <p>
                        The only language course running during the exam period is the Czech course on Wednesday.
                        The schedule for the spring courses will be published at the beginning of October 2019.
                    </p>--}}
                    {{-- <p>
                        Rozvrh pro následující semestr bude zveřejněn během druhého týdne semestru.
                    </p> --}}
                    {{--<p>
                        Our currently offered courses will end according to every teachers' wish or latest at the end of June.
                        Schedule for the autumn courses shall be published in October 2018.
                        Please note that during summer holidays there are no language classes provided by ESN.
                    </p>--}}
                    <p>
                        <a href="{{ url('files/languages-schedule.php') }}">
                            <img src="{{ asset('img/web/lang-schedule-icon.jpg') }}" />
                        </a>
                    </p>
                    <p>
                        Občas jsou některé hodiny z různých důvodů odřeknuty.
                        Následující tabulka zobrazuje aktuálně zrušené či přesunuté hodiny.
                    </p>
                    <iframe width="360" height="240" frameborder="0" src="https://docs.google.com/spreadsheets/d/e/2PACX-1vQnXcpxkS4GkgX_LsRkiAO15gb8_Dd_YT0nipSPN0vogdWX-6PIoxCUwtYgC41dOdZm3Oz16RMLV0ma/pubhtml?single=true&gid=802538365&output=html&widget=true"></iframe>

                </div>
            </div>
        </div>
    </section>
    @isset($contactLanguages)
        <section>
            <div class="container">
                <div class="row contacts">
                    <div class="col-auto mx-auto">
                        @include('partials.contact', ['contact' => $contactLanguages])
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
