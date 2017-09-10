@extends('layouts.saf.layout')

@section('lang', 'cs')

@section('title', 'ATHENS &ndash; ')

@section('page')
    @include('layouts.saf.header')

    <section>
        <h1>ATHENS</h1>
        <p>Jeden z mezinárodních programů, které ČVUT nabízí ve spolupráci se 13 evropskými
            univerzitami se jmenuje <abbr title="Advanced Technology Higher Education Network, Socrates">ATHENS</abbr>.
            Skrývá se pod ním týdenní kurz v listopadu/březnu, na kterém studujete jeden předmět
            s partou studentů ze všech koutů Evropy. Vyzkoušíte si pobyt v zahraničí, procvičíte
            angličtinu i další cizí jazyky. Navíc je z velké části hrazen stipendiem od ČVUT.</p>
        <h2>Města, do kterých se můžete podívat tento semestr</h2>
        <ul>
            <li>Paříž (Francie)</li>
            <li>Soluň (Řecko)</li>
            <li>Budapešť (Maďarsko)</li>
            <li>Delft (Nizozemsko)</li>
            <li>Lisabon (Portugalsko)</li>
            <li>Lovaň (Belgie)</li>
            <li>Trondheim (Norsko)</li>
            <li>Milán (Itálie)</li>
            <li>Madrid (Španělsko)</li>
            <li>Mnichov (Německo)</li>
            <li>Vídeň (Rakousko)</li>
            <li>Varšava (Polsko)</li>
            <li>Istanbul (Turecko)</li>
        </ul>
        <p>Více informacích o partnerských univerzitách najdete na <a href="http://www.athensnetwork.eu/network-list.html" target="_blank">oficiálních stránkách programu</a>.
            Kromě toho si na těchto stránkách můžete porovnat i náklady jednotlivých zemí.</p>

        <h2>Termín výjezdu a deadline přihlášek</h2>
        <p>Tento semestr se ATHENS koná na všech univerzitách <strong>11.&ndash;18. listopadu</strong> 2017.</p>
        <p>Na přihlášku nepotřebujete žádný jazykový certifikát ani projít testem,
            pouze si vyberete kurz z katalogu, který najdete <a href="http://www.athensprogramme.com/catalog" target="_blank">tady</a>.
            Deadline odevzdání přihlášek se blíží a jelikož ji musíte vyplňovat nejen online,
            ale i donést na svou fakultu, je dobré začít. :)</p>
        <p>Každá fakulta má termín odevzdání jindy, zpravidla dopoledne:</p>
        <ul>
            <li>21. září: MÚVS</li>
            <li>25. září: FD</li>
            <li>26. září: FS, FSv, FEL, FJFI, KÚ</li>
            <li>27. září: FA, FBMI</li>
        </ul>
        <p>Více informací o tom, jak vyplnit přihlášku a kam s ní zajít najdete na
            <a href="https://portal.cvut.cz/informace-pro-studenty/mezinarodni-programy/athens/" target="_blank">Portálu ČVUT</a>
            v sekci mezinárodní programy &ndash; Athens. Najdete tam i zprávy z pobytů.</p>

        <div>
            <div>
            <p>Zkuste si studium v zahraničí</p>
            <p>&bdquo;Jediný závazek je, že musíte odjet.&ldquo; Vojta Uhlíř</p>
            </div>
            <img src="{{ asset('img/saf/athens.jpg') }}" />
        </div>
    </section>
@endsection