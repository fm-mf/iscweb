@extends('czech.layouts.layout')
@section('title', 'Buddy program')

@section('header')
    <div class="header-wrapper buddy-program">
        <header>
            @include('czech.layouts.navigation')
            <h1>Buddy program</h1>
        </header>
    </div>
@endsection


@section('page')
    <section>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="text-uppercase">Co obnáší být Buddym?</h2>
                    <p>Krom toho že je to super cool</p>
                    <div class="row justify-content-center">
                        <div class="col-sm-9 col-md-6 col-lg-4 col-info">
                            <img src="{{ asset('img/buddy/laptop.jpg') }}" />
                            <h3>Výběr zahraničního studenta</h3>
                            <p>Rád by ses v budoucnu podíval do Francie? Zajímá tě, jakou povahu mají Kanaďané?
                                Nebo chceš lépe poznat naše německé sousedy? Rozhodnutí je jen na Tobě.
                                V databázi najdeš více než 400 studentů z různých zemí a kultur, mezi kterými můžeš vybírat.</p>
                        </div>
                        <div class="col-sm-9 col-md-6 col-lg-4 col-info">
                            <img src="{{ asset('img/buddy/airport.jpg') }}" />
                            <h3>Vyzvednutí na letišti</h3>
                            <p>Letiště je zpravidla to první místo v Česku, na které se zahraniční student dostane.
                                Máš tak jedinečnou šanci udělat nejlepší první dojem. Vyzvedni studenta hned po příjezdu,
                                pomoz mu s kufry a během dlouhé cesty z Ruzyně už vyprávěj, co všechno může zažít.
                                Máš originální nápad, jak ho u nás přivítat? Kreativitě se meze nekladou.</p>
                        </div>
                        <div class="col-sm-9 col-md-6 col-lg-4 col-info">
                            <img src="{{ asset('img/buddy/campus.jpg') }}" />
                            <h3>Ubytování a „Tour de Campus“</h3>
                            <p>Na řadu přichází ubytování. Většina studentů má kolej nebo podnájem už zařízené,
                                stačí jen najít správnou adresu mezi spletitými pražskými uličkami. A ukázka kampusu?
                                Zaveď ho k Rektorátu, navštivte knihovnu a projděte si fakultu, najděte nejbližší obchod
                                a procházku zakončete pravým českým pivem v té nejlevnější hospodě. Bude nadšen.</p>
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
                    <h2>Buddy session</h2>
                    <p>
                        Buddy Session je informační schůzka, kde se dozvíš vše potřebné k tomu,
                        jak být správným Buddym, a aktuální informace do nového semestru.
                        Většinou se koná zruba v polovině záři (ZS) a ledna (LS). Po tom,
                        co se do Buddy programu zaregistruješ, tě o ní budeme informovat
                        e‑mailem nebo na FB stránce
                        <a href="https://www.facebook.com/isc.ctu.prague" target="_blank" rel="noopener">ISC CTU in Prague</a>.
                        Pokud bys měl jakékoliv dotazy ještě před Buddy Session nebo jsi něco nenašel v Buddy příručce,
                        neváhej se zeptat našeho Buddy coordinátora na <a href="mailto:buddy@isc.cvut.cz">buddy@isc.cvut.cz</a>.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2>Buddy příručka</h2>
                    <p>
                        Všechny potřebné informace ohledně Buddy programu jsme sepsali do
                        <strong>Buddy příručky</strong>. Pomůže jak Tobě, tak Tvému zahraničnímu studentovi.
                        Obsahuje informace o tom <strong>nejdůležitějším</strong>, co budeš v prvních dnech
                        po příjezdu studenta potřebovat, ale i do dalších dní Ti dá pár rad.
                        Neváhej a čerpej z ní informace, aby jsi na nic důležitého nezapomněl(a).
                        Věříme, že v ní najdeš odpovědi na své otázky, a pokud ne, tak se ptej na
                        <a href="mailto:buddy@isc.cvut.cz">buddy@isc.cvut.cz</a>.
                    </p>
                    <p>
                        <a href="{{ route('buddy-handbook-cs') }}" class="btn btn-outline-dark">
                            <span class="fas fa-file-pdf"></span> Buddy příručka
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2><strong>Máš dotaz nebo si s něčím nevíš rady?</strong></h2>
                    <p>Napiš našemu Buddy coordinátorovi.</p>
                </div>
            </div>
            <ul class="row list-unstyled contacts">
                @foreach($contacts as $contact)
                    <li class="col-10 col-md-8 col-lg-6 ml-auto mr-auto">
                        @include('partials.contact', ['contact' => $contact])
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endsection
