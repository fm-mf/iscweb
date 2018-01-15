@extends('layouts.saf.layout')

@section('lang', 'cs')

@section('title', 'ATHENS &ndash; ')

@section('page')
    @include('layouts.saf.header')

    <section>
        <h1>ATHENS</h1>
        <p>Jeden z&nbsp;mezinárodních programů, které ČVUT nabízí ve spolupráci se 13 evropskými
            univerzitami se jmenuje <abbr title="Advanced Technology Higher Education Network, Socrates">ATHENS</abbr>.
            Skrývá se pod ním týdenní kurz v&nbsp;listopadu/březnu, na kterém studujete jeden předmět
            s&nbsp;partou studentů ze všech koutů Evropy. Vyzkoušíte si pobyt v&nbsp;zahraničí, procvičíte
            angličtinu i další cizí jazyky. Navíc je z&nbsp;velké části hrazen stipendiem od ČVUT.</p>
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
        <p>Tento semestr se ATHENS koná na všech univerzitách <strong>17.&ndash;24. března</strong> 2018.</p>
        <p>Na přihlášku nepotřebujete žádný jazykový certifikát ani projít testem,
            pouze si vyberete kurz z&nbsp;katalogu, který najdete <a href="http://www.athensprogramme.com/catalog" target="_blank">tady</a>.
            Deadline odevzdání přihlášek se blíží a jelikož ji musíte vyplňovat nejen online,
            ale i donést na svou fakultu, je dobré začít. :)</p>
        <p>Každá fakulta má termín odevzdání jindy, zpravidla dopoledne:</p>
        <ul>
            <li>22. ledna: MÚVS</li>
            <li>23. ledna: FS, FSv, FEL, FJFI, FA, FD, FIT</li>
            <li>24. ledna: FBMI, KÚ</li>
        </ul>
        <p>Více informací o tom, jak vyplnit přihlášku a kam s&nbsp;ní zajít najdete na
            <a href="https://portal.cvut.cz/informace-pro-studenty/mezinarodni-programy/athens/" target="_blank">Portálu ČVUT</a>
            v&nbsp;sekci Mezinárodní programy &ndash; Athens. Najdete tam i zprávy z pobytů, nebo si přečtěte
            následující zážitky našich kamarádů Vojty Uhlíře (<abbr title="Fakulta elektrotechnická">FEL</abbr>)
            a Martina Chovance (<abbr title="Fakulta informačních technologií">FIT</abbr>).</p>

        <div id="uhlir" class="inspiration light">
            <a href="https://www.facebook.com/notes/czech-it-abroad/zkus-si-studium-v-zahraničí/1555944037791485/" target="_blank">
                <div>
                    <p>Zkuste si studium v&nbsp;zahraničí</p>
                    <p>&bdquo;Jediný závazek je, že musíte odjet.&ldquo; Vojta Uhlíř</p>
                </div>
            </a>
        </div>

        <div id="chovanec" class="inspiration dark">
            <a href="https://www.facebook.com/notes/martin-chovanec/týden-v-paříži-s-čvut/10155732851099549/" target="_blank">
                <div>
                    <p>Zkuste si studium v&nbsp;zahraničí</p>
                    <p>&bdquo;Po týdnu v Paříži jsem se rozhodl vyrazit na semestr do Švýcarska,
                        což byla snad nejlepší věc, kterou jsem na ČVUT mohl udělat.&ldquo; Martin Chovanec</p>
                </div>
            </a>
        </div>

        <div id="stadler" class="inspiration dark">
            <a href="https://www.facebook.com/notes/michal-štádler/tour-de-kebab-athes-v-istanbulu/10154633984626548/" target="_blank">
                <div>
                    <p>Tour de Kebab (Athens v Istanbulu)</p>
                    <p>&bdquo;Z ČVUT jsme na Istanbul Technical University letěli 3. A všichni 3 s jediným cílem&hellip;&ldquo; Michal Štádler (FIT)</p>
                </div>
            </a>
        </div>
    </section>
@endsection
