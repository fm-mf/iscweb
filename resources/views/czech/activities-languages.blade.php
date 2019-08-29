@extends('czech.layouts.layout')
@section('title', 'Jazyky – Co děláme')

@section('page')
    @include('czech.partials.activities-header')
    @include('czech.partials.activities-menu')
    <section class="activities-detail">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <h3>Tandem program</h3>
                    <p>
                        Tandem je způsob vzájemného učení se jazyků.
                    </p>
                    <p>
                        Ve zkratce jde o to, že najdeš v naší databázi partnera,
                        který tě naučí cizí jazyk, a ty na oplátku naučíš jeho ten svůj.
                    </p>
                    <p>
                        Největší předností Tandem programu je to, že výuka bude probítat
                        pouze mezi vámi dvěma, takže si můžete určit čas a intenzitu
                        přesně tak, jak vám bude vyhovovat. Samozřejmě si můžeš najít
                        Tandem parťáků, kolik jen budeš chtít.
                    </p>
                    <p>
                        Zaregistruj se do naší <a href="{{ url('/tandem') }}"><strong>Tandem databáze</strong></a>
                        a najdi si svého partnera.
                    </p>
                    <p><a href="{{ url('/tandem') }}" class="btn btn-primary"><span class="fas fa-sign-in-alt"></span> Tandem databáze</a></p>
                </div>
                <div class="col-sm-4">
                    <h3>Přijď si popovídat na Café Lingea</h3>
                    <p>
                        Café Lingea je událost, kde si můžeš neformálně popovídat v různých jazycích.
                        Obvykle je zvolena angličtina a nějaký další jazyk – němčina, francouzština, španělština, ruština atd.
                    </p>
                    <p>
                        Café Lingea se koná <strong>Každé dva týdny</strong> ve vybrané kavárně nebo restauraci,
                        takže je to také dobrý způsob, jak objevovat nová místa po Praze.
                    </p>
                    <p>
                        Pro více informací se můžeš přidat do naší
                        <a href="https://www.facebook.com/groups/125659680939345/" target="_blank" rel="noopener">ISC Café Lingea facebookové skupiny</a>.
                    </p>
                </div>
                <div class="col-sm-4">
                    <p>
                        Chtěl by sis zlepšit nějaký jazyk nebo si zkusit vyučivání češtiny?
                    </p>
                    <h3>Využij naše jazykové kurzy!</h3>
                    <p>
                        Všechny naše kurzy vyučují přijíždějící zahraniční studenti a další cizinci žijící v Praze.
                        Kurzy se konají <strong>jednou týdně</strong> (90 min),
                        jsou skutečně zdarma a není na ně nutná žádná registrace.
                    </p>
                    <p>
                        Obvykle začínají druhý nebo třetí týden semestru
                        a konají se v prostorách ISC na Masarykově koleji.
                    </p>
                    <h3>Staň se učitelem</h3>
                    <p>
                        Vyučování jazyků je skvělá a zajímavá zkušenost!
                        Přijď naučit zahraniční studenty svůj jazyk a povědět jim něco o kultuře a zvycích.
                    </p>
                    <p>
                        Je možné vyučovat i ve dvojicích.
                    </p>
                    <p>
                        Pokud bys měl zájem, pošli e-mail na
                        <a href="mailto:languages@isc.cvut.cz"><strong>languages@isc.cvut.cz</strong></a>.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row contacts">
                <div class="col-auto mx-auto">
                    @include('partials.contact', ['contact' => $contactLanguages])
                </div>
            </div>
        </div>
    </section>
@endsection
