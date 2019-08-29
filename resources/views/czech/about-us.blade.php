@extends('czech.layouts.layout')
@section('title', 'O nás')

@section('header')
    <div class="header-wrapper about-us">
        <header>
            @include('czech.layouts.navigation')
            <h1>O nás</h1>
        </header>
    </div>
@endsection

@section('page')
    <section>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2>Jak to začalo?</h2>
                    <p>
                        Historie International Student Clubu (ISC) sahá až do roku 1999,
                        kdy se dva čeští studenti vrátili ze svého výměnného programu v USA
                        a ve spolupráci s Odborem zahraničních vztahů rektorátu ČVUT
                        rozjeli klíčovou aktivitu našeho klubu – Buddy program.
                    </p>
                    <p>
                        Od té doby se podílíme na vytváření mezinárodní komunity na ČVUT.
                        Zapojujeme přijíždějící zahraniční studenty do dění na naší univerzitě
                        a zároveň umožňujeme českým studentům poznat jejich kulturu.
                    </p>
                    <p>
                        Jen minulý rok jsme pomohli více než tisícovce přijíždějících studentů
                        s jejich prvními kroky v Česku, které často bývají náročné.
                        Během semestru jsme pro ně, stejně jako pro české studenty,
                        připravili desítky různorodých aktivit – od výletů přes výuku jazyků,
                        kulturní večery, sporty až po beer jógu.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="text-left">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-7 col-lg-8">
                    <h2>Struktura ISC</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-7 col-lg-8">
                    <p>
                        Aby byl ve věcech trochu pořádek, konkrétní aktivity mají na starosti
                        jednotlivé teamy (nebo spíš teamky). Každý team má Koordinátora,
                        který za něj zodpovídá. Kdokoliv se může zapojit do jakéhokoliv teamu,
                        nebo je třeba vyzkoušet všechny.
                    </p>
                    <p>
                        ISC je také členem <strong>Erasmus Student Network</strong> (ESN),
                        což je organizace sdružující zhruba 530 studentských kubů po celé Evropě,
                        do jejichž činnosti se zapojuje přes 40 000 dobrovolníků,
                        kteří každoročně pomáhají zhruba 350 000 zahraničních studentů.
                    </p>
                    <p>
                        Kromě této mezinárodní sítě jsme také externím klubem
                        <strong>Studentské unie ČVUT</strong>. Studentskou unii tvoří
                        spousta různých klubů, které organizují nespočet pravidelných
                        a ještě více nepravidelných aktivit od sportovních klání, přednášek,
                        hudebních festivalů, promítání po nejrůznější kurzy.
                    </p>
                </div>
                <div class="col-sm-6 col-md-5 col-lg-4 d-flex flex-column justify-content-around">
                    <div class="row">
                        <div class="col-8 col-sm-10 col-xl-8 ml-auto mr-auto">
                            <a href="{{ url('/') }}">
                                <img src="/img/logos/isc-logo-color-horizontal.svg" alt="Logo ISC CTU in Prague" />
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8 col-sm-10 col-xl-8 ml-auto mr-auto">
                            <a href="https://www.esncz.org">
                                <img src="/img/logos/esn-cz/esn-cz-logo-colour.svg" alt="Logo ESN CZ" />
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10 col-sm-12 col-xl-10 ml-auto mr-auto">
                            <a href="https://su.cvut.cz">
                                <img src="/img/logos/su/su-logo-side-col.svg" alt="Logo Studentské unie ČVUT" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2>Naše vize</h2>
                    <p>
                        ISC vize je myšlenka, která stojí za vším, co děláme. Vyjadřuje naše odhodlání
                        a proč děláme věci takovým způsobem, jakým je děláme. Zní následovně:
                    </p>
                    <blockquote>
                        Vizí ISC je vytváření mezinárodní komunity na ČVUT v Praze.
                        Chceme integrovat zahraniční studenty do života v České republice
                        a dění na naší univerzitě. Vytváříme prostředí, kde se setkávají různé kultury
                        a poznávají čeští a zahraniční studenti. Podporujeme aktivní zapojení
                        našich členů, jejich seberealizaci a osobní rozvoj v kreativním prostředí,
                        kde panuje otevřená a přátelská atmosféra. Tím přispíváme k porozumění,
                        přátelství a spolupráci mezi jednotlivými národy v rámci Evropy i celého světa.
                    </blockquote>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2>Kde nás najdeš?</h2>
                    <p>
                        Sídlem našeho klubu tzv. <strong>ISC Point</strong> na Masarykově koleji
                        v místnosti <strong>R304</strong>, ve třetím patře v červené části.
                        Masarykova kolej je trochu bludiště, a proto je nejlepší sledovat
                        od schodů naproti vchodu směrovky s naším logem. ISC Point je místo,
                        kam se po příjezdu podívá téměř každý zahraňák a vyzvedne si svůj Welcome pack.
                        Navíc, pokud bude mít v budoucnu nějaké problémy, rádi mu tam poradíme a pomůžeme.
                    </p>
                    <p>
                        Kromě ISC Pointu spravujeme ještě dvě učebny – B305 a R404,
                        kde probíhají naše jazykové kurzy, schůzky našich teamků
                        a některé aktivity pro zahraniční a české studenty.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
