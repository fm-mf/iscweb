{{--/**
 * Created by PhpStorm.
 * User: mobil
 * Date: 18/05/2018
 * Time: 20:51
 */--}}
@extends('web.layouts.subpage')
@section('wrapper-class', 'about-wrapper')
@section('navClass', 'navbar-dark')
@section('title', 'Souhlas se zpracováním osobních údajů')
@section('titleClass','title-privacy')

@section('content')

    <div class="container subpage">
        <div class="row vision">
            <div class="col-sm-12">
                <p>
                    V tomto prohlášení vám představíme, jak my, International Student Club CTU in Prague, z. s.,
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
                    může to být například poskytování webového hostingu nebo mailovací systémy.
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
                    neváhejte nás <a href="{{ action('Web\WebController@showContacts') }}">kontaktovat</a>.
                </p>
            </div>
        </div>
    </div>
@endsection
