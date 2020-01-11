@extends('web.layouts.layout')
@section('title', 'Souhlas se zpracováním osobních údajů')

@section('page')
    <section id="privacy">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1>Souhlas se zpracováním osobních údajů</h1>
                    <p>
                        V tomto prohlášení vám představíme, jak my, {{ $officialName }},
                        Thákurova 550/1, 160 00 Praha 6, IČO: 22841032, používáme osobní informace, které nám svěříte.
                    </p>
                    <p>
                        Během registrace nám sdělujete následující informace, kdy některé z nich nejsou povinné:
                    </p>
                    <ul>
                        <li>vaše jméno a příjmení,</li>
                        <li>e-mailovou adresu a telefon,</li>
                        <li>pohlaví a rok narození.</li>
                    </ul>
                    <p>
                        Tyto informace potřebujeme k zajištění fungování Buddy programu. Když si vyberete zahraničního studenta,
                        kterému budete buddíkem, automaticky mu o tom posíláme e-mail spolu s vaším jménem, příjmením a e-mailem.
                    </p>
                    <p>
                        Využíváme služeb třetích stran, za účely usnadnění práce s našimi službami a jejich zpřístupnění;
                        může to být například poskytování webového hostingu nebo e-mailové systémy.
                    </p>
                    <p>
                        Vynakládáme maximální úsilí, abychom vaše data uchovali v bezpečí a zabránili jejich neoprávněnému použití.
                    </p>
                    <p>
                        Toto prohlášení můžeme občas doplňovat a upravovat. Měli byste tuto stránku pravidelně kontrolovat,
                        abyste o všech změnách měli přehled. Poslední aktualizace: 1. 5. 2018.
                    </p>
                    <p>
                        Pokud máte jakékoliv otázky ohledně bezpečnosti a zpracování osobních údajů,
                        neváhejte nás <a href="{{ route('czech.contacts') }}">kontaktovat</a>.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
