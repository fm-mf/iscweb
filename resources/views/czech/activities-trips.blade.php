@extends('czech.layouts.layout')
@section('title', 'Výlety – Co děláme')

@section('page')
    @include('czech.partials.activities-header')
    @include('czech.partials.activities-menu')
    <section class="activities-detail">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Výlety pro zahraniční studenty</h3>
                    <p>
                        Naším cílem je ukáza zahraňákům něco málo z naší vlasti,
                        seznámit je s naším kulturním i přírodním dědictvím,
                        ale také ukázat jim zákoutí, o kterých by se jinak nedozvěděli.
                        Samozřejmě se neomezujeme jenom na Českou republiku!
                        Rádi se podíváme i k našim sousedům.
                    </p>
                    <p>
                        Chceš se podívat do lázní? Jel bys se zahraňáky na vodu?
                        Těšíš se na pěší výlet v některé z přírodních rezervací?
                        Rád bys viděl východ slunce na Sněžce?
                        Nebo znáš bezva hospodu ve svém rodném městě?
                    </p>
                    <p>
                        Fantazii se meze nekladou a v ISC se vždycky najde někdo,
                        kdo ti s přípravou výletu pomůže. Nebo můžeš napst našemu
                        <strong>Trips koordinátorovi</strong> a přidat se
                        k organizačnímu týmu některého z již naplánovaných výletů
                    </p>
                </div>
                <div class="col-sm-6">
                    <h3>Výlety během Orientation Weeku</h3>
                    <p>
                        Těsně před začátkem semestru seznamujeme přijíždějící studenty
                        se životem v Česku během Orientačního týdne. Od čtvrtka do neděle
                        pak pořádáme několik výletů do různých koutů České republiky.
                    </p>
                    <p>
                        Na každý výlet jsou celkem čtyři organizátoři a vždy se nechává
                        jedno nebo dvě místa pro nováčky. Co to znamená? Většina zodpovědnosti
                        leží na zkušenáých členech ISC a ty se můžeš připojit, s něčím pomoct,
                        užit si den nebo dva se zahraňáky, podívat se někam, kde jsi třeba
                        ještě nebyl a vyzkoušet si, jak to v ISC vypadá z organizátorské strany.
                    </p>
                    <p>
                        Chtěl by ses zapojit? Náš <strong>Activities koordinátor</strong> ti určitě poradí!
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row contacts">
                <div class="col-10 col-md-8 col-lg-6 mx-auto">
                    @include('partials.contact', ['contact' => $contactTrips])
                </div>
                <div class="col-10 col-md-8 col-lg-6 mx-auto">
                    @include('partials.contact', ['contact' => $contactActivities])
                </div>
            </div>
        </div>
    </section>
@endsection
