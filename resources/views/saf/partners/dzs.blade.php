@extends('layouts.saf.partner-subpage')

@section('title', 'Dům zahraniční spolupráce &ndash; ')

@section('page')
    @parent

    <section>
        <div>
            <img src="{{ asset('img/saf/partners/logo-dzs.png') }}"
                 alt="Logo Domu zahraniční spolupráce"
                 title="Logo Domu zahraniční spolupráce"
                 class="logo" />
        </div>
        <h1>Dům zahraniční spolupráce</h1>
        <p>Dům zahraniční spolupráce (DZS) je příspěvkovou organizací Ministerstva školství, mládeže a tělovýchovy,
            který má v České republice na starosti všechny mezinárodní výměnné studijní programy.
            Jeho aktivity jsou určeny všem bez rozdílu: organizacím, firmám věnujícím se vzdělávání,
            vědě a výzkumu, orgánům místních samospráv, ale také studentům, pedagogům,
            vedoucím pracovníkům a dalším odborníkům.</p>
    </section>
    <section>
        <h2>Co tedy vlastně DZS dělá?</h2>
        <p>Prostřednictvím svých činností přispívá k mezinárodní spolupráci v oblasti formálního
            i neformálního vzdělávání, poskytuje granty a stipendia na mezinárodní projekty
            a mobility, přispívá k rozvoji škol a dalšímu vzdělávání zaměstnanců škol
            a pracovníků s mládeží. Dokáže pomoci i s kariérním poradenstvím, podporuje studium
            cizinců v ČR a podílí se na podpoře českého kulturního dědictví v zahraničí tím,
            že organizačně zajišťuje působení českých učitelů a lektorů v zahraničí.</p>
    </section>
@endsection