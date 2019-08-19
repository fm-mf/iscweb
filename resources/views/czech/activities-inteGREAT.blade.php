@extends('czech.layouts.layout')
@section('title', 'inteGREAT – Co děláme')

@section('page')
    @include('czech.partials.activities-header')
    @include('czech.partials.activities-menu')
    <section class="activities-detail">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h3>inteGREATion</h3>
                    <p>
                        Na úvod semestru je třeba zahraňáky uvítat! A jak to jde nejlépe?
                        No jasně že pořádnou party! Proto v průběhu <abbr title="Orientation Week">OWčka</abbr>
                        (obvykle poslední středu před začátkem semestru) můžeš dorazit na
                        <strong>inteGREATion party</strong>!
                    </p>
                    <p>
                        Hned v následujících týdnech se můžeš těšit na Českou prezentaci!
                        Trikolóra, pivo, chlebíčky, mazurka a plno dalšího!
                        Každý zahraňák přece musí poznat, co znamená žít v Česku.
                    </p>
                    <p>
                        Nejen že se párty můžeš zúčastnit, ale budeme rádi,
                        když se i staneš součástí teamu a zapojíš se do organizace.
                    </p>
                </div>
                <div class="col-sm-6">
                    <h3>A co následuje dál? Culture Evenings!</h3>
                    <p>
                        Každý semestr přijíždí do Prahy studenti ze zhruba 40 zemí.
                        Představ si rozmanitost kultur, tradic, místních zvyků
                        nebo třeba tradičních kuchyní, které díky tomu můžeš poznat.
                    </p>
                    <p>
                        Proto máme inteGREAT tým, který společně se zahraničními studenty
                        připravuje kulturní večery, díky kterým se jak zahraniční
                        tak čeští studenti mají možnost seznámit s ostatními národy
                        a prezentovat své země.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row contacts">
                <div class="col-auto mx-auto">
                    @include('partials.contact', ['contact' => $contactInteGreat])
                </div>
            </div>
        </div>
    </section>
@endsection
