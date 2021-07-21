@extends('czech.layouts.layout')

@section('header')
    <div class="header-wrapper home">
        <header>
            @include('czech.layouts.navigation')
            <div class="container header">
                <h1>Chceš potkat nové kamarády z celého světa, zlepšit si cizí jazyk a podílet se na vytváření mezinárodní komunity na ČVUT?</h1>
                <p class="p-btn">
                    <a class="btn btn-primary mb-3 mb-md-0" href="{{ route('register') }}">
                        <span class="fas fa-user-plus"></span> Staň se Buddym!
                    </a>

                    <a class="btn btn-secondary ml-md-3" href="{{ route('buddy-handbook-cs') }}" target="_blank">
                        <span class="fas fa-file-pdf"></span> Buddy příručka
                    </a>
                </p>
            </div>
            <div class="play">
                {{-- Buddy video: --}}
                <a class="fancybox-media" href="https://player.vimeo.com/video/104401781"><span class="fas fa-play-circle fa-5x"></span></a>
                {{-- ID video: --}}
                {{--<a class="fancybox-media" href="https://player.vimeo.com/video/163983964"><span class="fas fa-play-circle fa-5x"></span></a>--}}
            </div>
            <p class="scroll-down"><a href="#info" class="link link-more" id="scroll">Co je to ISC a jak se zapojit? <br> <span class="fas fa-chevron-down fa-lg"></span></a></p>
            <div class="row justify-content-center align-items-stretch align-content-center logos">
                <div class="col-auto">
                    <a href="https://www.esn.org" class="logo" target="_blank" rel="noopener">
                        <img src="{{ asset('img/logos/esn/esn-logo-white.svg') }}" alt="Logo Erasmus Student Network" />
                    </a>
                    <a href="https://www.cvut.cz" class="logo logo-cvut" target="_blank" rel="noopener">
                        <img src="{{ asset('img/logos/cvut/logo_CVUT_negativ.svg') }}" alt="Logo Českého vysokého učení techického v Praze" />
                    </a>
                </div>
            </div>
        </header>
    </div>
@endsection

@section('page')
    <section id="info">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2>Kdo jsme?</h2>
                    <p>
                        International Student Club je skupinou mladých a aktivních lidí, kteří ve svém
                        volném čase chtějí dělat něco smysluplného a při tom se rádi baví.
                        Každý semestr integrujeme zahraniční studenty do života a dění na naší univerzitě i v celé ČR.
                        Zároveň se od nich sami učíme a zjišťujeme, jak to chodí v ostatních koutech světa.
                        Zábavným způsobem tak poznáváme jiné kultury a získáváme spoustu skvělých příležitostí seberealizace,
                        podporujeme aktivní zapojení našich členů a jejich osobní rozvoj.
                    </p>
                    <p>
                        Chceš vědět více?
                    </p>
                    <p>
                        <a href="{{ url('czech/about-us') }}" class="btn btn-outline-dark">O nás</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2>Chceš se zapojit?</h2>
                    <p>
                        Každý rok se postaráme o zhruba 1 000 přijíždějících studentů!
                        A to samozřejmě nedokážeme bez pomoci dobrovolníků, jako jsi třeba právě Ty.
                        Můžeš se pro začátek zapojit například do Buddy programu,
                        přijít se s námi seznámit na některou z našich akcí,
                        a nebo se stavit rovnou u nás v klubu na Masarykově koleji (R304 – jednoduše sleduj šipky).
                    </p>
                    <p>Taky nás můžeš kontaktovat skrz kterékoliv z našich online médií.</p>
                    <div class="row justify-content-center text-left">
                        <ul class="col-auto list-unstyled social-media-links">
                            <li>
                                <a href="https://www.facebook.com/isc.ctu.prague" target="_blank" rel="noopener">
                                    <span class="fab fa-facebook-square fa-2x"></span> ISC CTU in Prague
                                </a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/isc.cvut/" target="_blank" rel="noopener">
                                    <span class="fab fa-instagram fa-2x"></span> @isc.cvut
                                </a>
                            </li>
                            <li>
                                <a href="mailto:isc@isc.cvut.cz" target="_blank">
                                    <span class="fas fa-envelope-open-text fa-2x"></span> isc@isc.cvut.cz
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('czech.partials.buddy-handbook-section')
    <section id="instafeed-container" class="d-none">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2>Instafeed</h2>
                    <div id="instafeed"></div>
                </div>
            </div>
        </div>
    </section>
@endsection
