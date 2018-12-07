<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Buddy Program | ISC CTU in Prague</title>

    <link rel="icon" type="image/vnd.microsoft.icon" href="{{ asset('img/favicon.ico') }}" sizes="16x16 32x32 64x64" />

    <link href="{{ asset('css/buddy.css') }}" rel="stylesheet" type="text/css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/jquery.fancybox.css" type="text/css" media="screen" />


    <script type="text/javascript" src="//use.typekit.net/aav2ndi.js"></script>
    <script type="text/javascript">try { Typekit.load();} catch (e) {}</script>
</head>
<body id="page-top">
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-MPBKF8" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){ w[l]=w[l]||[];w[l].push({ 'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-MPBKF8');</script>
<div class="site-wrapper" >
    <!------------------------------ Logo and navigation ----------------------------------->
    <nav class="navbar navbar-custom" role="navigation">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand link" href="#page-top">
                        <img src="{{ asset('img/buddy/logo.png') }}" alt="International Student Club">
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                    <ul class="nav navbar-nav">
                        <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                        <li class="hidden">
                            <a href="#page-top"></a>
                        </li>
                        <li>
                            <a href="#o-nas" class="link">O NÁS</a>
                        </li>
                        <li>
                            <a href="#faq" class="link">FAQ</a>
                        </li>
                        <li>
                            <a href="#buddy-prirucka" class="link">BUDDY PŘÍRUČKA</a>
                        </li>
                        <li>
                            <a href="#contact" class="link">KONTAKT</a>
                        </li>
                        <li>
                            <a href="{{ action('Buddyprogram\ListingController@listExchangeStudents') }}" class="button">Buddy Program <small>(přihlášení)</small></a>
                        </li>
                        <li>

                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /row -->
        </div><!-- /.container -->
    </nav>

    <div class="play">
        <!-- Buddy video: -->
        <a class="fancybox-media" href="https://player.vimeo.com/video/104401781"><i class="fa fa-play-circle fa-5x"></i></a>
        <!-- ID video: -->
        <!--<a class="fancybox-media" href="player.vimeo.com/video/163983964"><i class="fa fa-play-circle fa-5x"></i></a>-->
    </div>
    <div class="container header">
        <h1>Chceš potkat nové kamarády <br> z celého světa, zlepšit cizí jazyk a podílet se na vytváření mezinárodní komunity na ČVUT?</h1>
        <p class="p-btn">
            <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal-registration">Staň se Buddym!</button> -->
            <a href="{{ action('Auth\RegisterController@showRegistrationForm') }}"><button type="button" class="btn btn-primary btn-lg">Staň se Buddym!</button></a>
            <span class="show-menu"></span>
        </p>
    </div>
    <p class="scroll-down"><a href="#info" class="link link-more" id="scroll">Chci se dozvědět více o Buddy programu <br> <span class="glyphicon glyphicon-chevron-down" style="font-size:20px;"></span></a></p>
</div>
<!-- ============================= Registrace (Modal) ====================================== -->
<div class="modal fade" id="modal-registration">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Zavřít</span></button>
                <h4 class="modal-title">REGISTRACE DO BUDDY PROGRAMU</h4>
            </div>
            <div class="modal-body">
                <div class="err-msgs" id="msgs">
                </div>
                <div class="form-body">
                    <p>Pojď do toho s námi!</p>
                    <span class="line"></span>
                    <form role="form" action="/muj-buddy/register/email" method="post" class="registration" onsubmit="sendForm(this);
                                    return false;">
                        <div class="form-group">
                            <label for="input-email">Zadej svůj email</label>
                            <input type="email" name="email" id="email" class="form-control" id="input-email" placeholder="Email">
                            <button type="submit" class="btn btn-default submit">REGISTROVAT</button>
                        </div>
                    </form>
                    <!--<p>Máš již svůj účet? <a href="#">Přihlaš se zde</a>.</p>-->
                </div>
                <p class="a-close"><a href="#" data-dismiss="modal">Zavřít</a>
            </div>
        </div>
    </div>
</div>

{{-- S ČVUT do světa --}}
{{--
<h2>S ČVUT do světa</h2>
<div class="container info">
    <div class="row">
        <div class="col-lg-7 col-md-5 col-sm-12">
            <p>Na ČVUT je možnost vyjet do zahraničí pro více než 1000 studentů každý rok. V loňském roce se
                přitom obsadila méně než polovina volných míst. Šance dostat se na Erasmus nebo Mimoevropské
                bilaterální dohody je obrovská.</p>
            <p>Od 11. do 25. října budou probíhat na fakultách cestovatelské přednášky od studentů,
                kteří již vyjeli.</p>
            <p>Program a další informace naleznete na stránce <a href="{{ action('Saf\SafController@showIndex') }}">S ČVUT do světa.</a></p>
            <p>Sledujte také naši <a href="https://www.facebook.com/isc.saf" target="_blank" rel="noopener"><span class="glyphicon glyphicon-thumbs-up"></span> Facebookovou stránku</a>.</p>
        </div>
        <div class="col-lg-5 col-md-7 col-sm-12">
            <a href="{{ action('Saf\SafController@showIndex') }}">
                <img class="image" src="{{ asset('img/saf/logo-s-cvut-do-sveta.png') }}" alt="Logo S ČVUT do světa" title="Logo S ČVUT do světa" />
            </a>
        </div>
    </div>
</div>
--}}
<!-- ============================= Kalendář ====================================== -->
{{--
<h2 id="info">Kalendář mezinárodních událostí</h2>

<div class="container events">
    <div class="container container-ow container-sm-height">
        <div class="row row-ow row-sm-height">
            <div class="col-sm-6 ow-day col-sm-height" style="background-image:url({{ asset('img/buddy/events/Co_je_isc.png') }});">
                <span class="day">Pondělí<br>13.1.<br>19:00<br>Co je ISC a jak se zapojit?</span>
            </div>
            <div class="col-sm-6 ow-detail col-sm-height col-top">
                <p>Nikdy jsi neslyšel/a o ISC? Nestihl/a Buddy Session před začátkem semestru? Chceš si otevřít dveře do světa a najít kamarády ze všech kontinentů? Nebo prostě chceš vědět víc?

                <p> Tak už neváhej a přijď na informační přednášku o ISC a zjistíš, co děláme a jak se právě ty můžeš zapojit.

                <p>Více na události <a href="https://www.facebook.com/events/1781891538799947/">&nbsp;<img src="{{ asset('img/web/fb.png') }}" width="17px">&nbsp;</a>
            </div>
        </div>
    </div>
</div>
--}}
{{--<h2></h2>
<div class="container events">
    <div class="container container-ow container-sm-height">
        <div class="row row-ow row-sm-height">
            <div class="col-sm-6 ow-day col-sm-height" style="background-image:url({{ asset('img/web/events/grillyourbuddy.png') }});">
                <span class="day">Středa<br>14.6.<br>16:00<br>ISC Grilovačka</span>
            </div>
            <div class="col-sm-6 ow-detail col-sm-height col-top">
                <p>Ahoj všichni,
                    zveme vás na skvělou ISC grilovačku, kde budete mít možnost setkat se se současnými Parťáky, s Alumni, ale třeba i s Rektorátníky.
                    Ohlédneme se za uplynulým semestrem, představíme nové koordinátory a rozloučíme se s těmi končícími.
                <p>Více na události <a href="https://www.facebook.com/events/310899549335186/" target="_blank">&nbsp;<img src="{{ asset('img/web/fb.png') }}" width="17px">&nbsp;</a>
            </div>
        </div>
    </div>
</div>--}}

<div id="info"></div>
@if (\Carbon\Carbon::now('Europe/Prague')->lt(\Carbon\Carbon::create(2018, 9, 12, 18, 00, 00, 'Europe/Prague')->addHours(2)))
<h2>Jak se stát Buddym</h2>

<div class="container events">
    <div class="container container-ow container-sm-height">
        <span class="vspace"></span>
        <div class="row row-ow row-sm-height">
            <div class="col-sm-6 ow-day ow-3 col-sm-height" style="background-image:url({{ asset('events/covers/163.jpeg') }})">
                <span class="day">Středa<br><strong>12.</strong><br>září<br>18:00</span>
                <h2>Buddy session</h2>
            </div>
            <div class="col-sm-6 ow-detail col-sm-height col-top">

                <p>Staň se Buddym!</p>
                <p>Co obnáší být Buddym? Vybereš si zahraničního studenta dle svého uvážení
                    a pomůžeš mu s jeho prvními kroky v Česku. Není to nic náročného.</p>
                <p>Na Buddy Session vysvětlíme, co je třeba se zahraňákem zařídit.
                    Také představíme aktivity, které v průběhu semestru ISC organizuje
                    a jak se do nich případně můžeš zapojit i ty.</p>
                <p>Akce proběhne ve vzdělávacím centru NTK od 18:00
                    (u vstupu NTK3 naproti noční studovně, od recepce po schodech do 2. patra).</p>
                <p>
                    ► <a href="https://www.facebook.com/events/526558587785646/" target="_blank" rel="noopener"><strong>Facebook event!</strong></a>
                </p>
            </div>
        </div>
    </div>
</div>
@endif
@if (\Carbon\Carbon::now('Europe/Prague')->lt(\Carbon\Carbon::create(2017, 10, 8, 18, 00, 00, 'Europe/Prague')))
    <div class="container events">
        <div class="container container-ow container-sm-height">
            <span class="vspace"></span>
            <div class="row row-ow row-sm-height">
                <div class="col-sm-6 ow-day ow-3 col-sm-height" style="background-image:url(https://www.isc.cvut.cz/events/covers/61.jpeg)">
                    <span class="day">Pátek&ndash;Neděle<br><strong>6.&ndash;8.</strong><br>října</span>
                    <h2>Buddy Weekend</h2>
                </div>
                <div class="col-sm-6 ow-detail col-sm-height col-top">

                    <p>Za odměnu všem buddíkům! Neváhejte, bude to sranda!<p>

                    <p>Kde: přísně tajné</p>
                    <p>Více info a registrace: <a href="mailto:buddy@isc.vvut.cz">buddy@isc.cvut.cz</a>
                    <p>Cena: 300 Kč</p>
                </div>
            </div>
        </div>
    </div>
@endif

<!-- ============================= Co to obnáší ====================================== -->
<h2>CO OBNÁŠÍ BÝT BUDDYM?</h2>
<h2><small>Krom toho že je to super cool</small></h2>
<div class="container info">

    <div class="row">
        <div class="col-sm-4 col-info">
            <img src="{{ asset('img/buddy/laptop.jpg') }}">
            <h3>Výběr zahraničního studenta</h3>
            <p class="text-align-left">Rád by ses v budoucnu podíval do Francie? Zajímá tě, jakou povahu mají Kanaďané?
                Nebo chceš lépe poznat naše německé sousedy? Rozhodnutí je jen na Tobě.
                V databázi najdeš více než 400 studentů z různých zemí a kultur, mezi kterými můžeš vybírat.</p>
        </div>
        <div class="col-sm-4 col-info">
            <img src="{{ asset('img/buddy/airport.jpg') }}">
            <h3>Vyzvednutí na letišti</h3>
            <p class="text-align-left">Letiště je zpravidla to první místo v Čechách, na které se zahraniční student dostane.
                Máš tak jedinečnou šanci udělat nejlepší první dojem. Vyzvedni studenta hned po příjezdu,
                pomoz mu s kufry a během dlouhé cesty z Ruzyně už vyprávěj, co všechno může zažít.
                Máš originální nápad, jak ho u nás přivítat? Kreativitě se meze nekladou.</p>
        </div>
        <div class="col-sm-4 col-info">
            <img src="{{ asset('img/buddy/campus.jpg') }}">
            <h3>Ubytování a "Tour de Campus"</h3>
            <p class="text-align-left">Na řadu přichází ubytování. Většina studentů má kolej nebo podnájem už zařízené,
                stačí jen najít správnou adresu mezi spletitými pražskými uličkami. A ukázka kampusu?
                Zaveď ho k Rektorátu, navštivte knihovnu a projděte si fakultu, najděte nejbližší obchod
                a procházku zakončete pravým českým pivem v té nejlevnější hospodě. Bude nadšen. </p>
        </div>
    </div>
</div>

{{--
        <div class="container info" id="info">

            <div class="row">
                <div class="col-sm-10 col-sm-offset-1 text-align-center">
                    <h2>DŘÍVĚJŠÍ UBYTOVÁNÍ NA KOLEJÍCH PRO MIMOPRAŽSKÉ BUDDÍKY</h2>
                    <p>Bydlíš mimo Prahu a je proto pro tebe problém vyzvednout zahraničního studenta? Právě kvůli tomu jsme vyjednali se SÚZ výjimku. Buddíci se mohou na kolejích ubytovat dříve než ostatní studenti. Konkrétně tedy od 10.9.</p>
                    <p>Máš zájem? Napiš na <a href="mailto:buddy@isc.cvut.cz">buddy@isc.cvut.cz</a> a nech to na nás!</p>
                </div>
            </div>
        </div>

--}}

<div class="container info">
    <div class="row" id="buddy-session">
        <div class="col-sm-10 col-sm-offset-1 text-align-center">
            <h2>Buddy Session</h2>
            <p>Buddy Session je informační schůzka, kde se dozvíš vše potřebné k tomu, jak být
                správným Buddym, a aktuální informace do nového semestru. Většinou se koná zruba
                v&nbsp;polovině záři (ZS) a ledna (LS). Po tom, co se do Buddy programu
                zaregistruješ, tě o ní budeme informovat emailem nebo na FB stránce
                <a href="https://www.facebook.com/isc.ctu.prague" target="_blank" rel="noopener">ISC CTU in Prague</a>.
                Pokud bys měl jakékoliv dotazy ještě před Buddy Session nebo jsi něco nenašel
                v&nbsp;Buddy příručce, neváhej se zeptat našeho Buddy coordinátora na
                <a href="mailto:buddy@isc.cvut.cz">buddy@isc.cvut.cz</a>.</p>
        </div>
    </div>
</div>

<div class="container info">
    <div class="row" id="buddy-prirucka">
        <div class="col-sm-10 col-sm-offset-1 text-align-center">
            <h2>Buddy příručka</h2>
            <p>Všechny potřebné informace ohledně Buddy programu jsme sepsali do
                <strong>Buddy příručky</strong>. Pomůže jak Tobě, tak Tvému zahraničnímu
                studentovi. Obsahuje informace o tom <strong>nejdůležitějším</strong>, co budeš
                v&nbsp;prvních dnech po příjezdu studenta potřebovat, ale i do dalších dní Ti dá
                pár rad. Neváhej a čerpej z&nbsp;ní informace, aby jsi na nic důležitého
                nezapomněl(a). Věříme, že v&nbsp;ní najdeš odpovědi na své otázky a pokud ne,
                tak se ptej na <a href="mailto:buddy@isc.cvut.cz">buddy@isc.cvut.cz</a>.
            </p>

            <p>
                <a href="{{ url('buddy-prirucka') }}">
                    <button type="button" class="btn btn-default">Stáhnout Buddy Příručku (PDF)</button>
                </a>
            </p>
        </div>
    </div>
</div>

<!-- ============================= About us ====================================== -->
<div class="about-wrapper">
    <div class="container-fluid about" id="o-nas">
        <div class="row">
            <h2><strong>O NÁS</strong></h2>
        </div>
    </div>
    <div class="container">
        <div class="row vision">
            <div class="col-sm-10 col-sm-offset-1 grey">
                <p><strong>International Student Club</strong> je skupinou mladých a aktivních lidí,
                    kteří ve svém volném čase chtějí dělat něco smysluplného a při tom se rádi baví.
                    Každý semestr integrujeme zahraniční studenty do života a dění na naší univerzitě i v celé ČR.
                    Zároveň se od nich sami učíme a zjišťujeme, jak to chodí v ostatních koutech světa.</p>

                <p>Zábavným způsobem tak poznáváme jiné kultury a získáváme spoustu skvělých příležitostí
                    <strong>seberealizace</strong>, podporujeme <strong>aktivní zapojení</strong> našich členů
                    a jejich <strong>osobní rozvoj</strong>.</p>

                <p>A jak je možné, že nám to tak dobře klape? Protože otevřená a přátelská atmosféra, spolupráce v teamu
                    a poznávání národů v rámci Evropy i celého světa, to vše nás neustále žene dopředu. Už od roku 1999.</p>
            </div>
        </div>
    </div>
</div>

<!-- ============================= Kontakt ====================================== -->
<div class="container-fluid contact grey">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h3>PRŮVODCE SVĚTEM ISC</h3>
                <p class="text-align-center">
                    Chceš mít přehled o aktuálním dění v ISC? Vědět o každé akci, která se chystá, a přečíst si o těch,
                    které už proběhly? Dozvědět se další zajímavosti z historie a fungování ISC
                    a zkrátit si dlouhou chvíli rozhovorem se zajímavými lidmi?
                    To a ještě víc najdeš v našem časopisu Průvodce světem ISC.
                </p>
                <p class="text-align-center">
                    <a href="https://drive.google.com/drive/folders/0B6FVYAfC-ldzOU9vUC1ZS050cTA?usp=sharing" target="_blank" rel="noopener">
                        <button type="button" class="btn btn-default">ISC tiskoviny</button>
                    </a>
                </p>
            </div>
            <div class="col-sm-4" id="contact">
                <h3>KONTAKT</h3>
                <p class="text-align-center"><strong>International Student Club CTU in Prague</strong><br>
                    Thákurova 1, Praha 6 (Dejvice)<br>
                    <a href="mailto:buddy@isc.cvut.cz">buddy@isc.cvut.cz</a><br>
                    Facebook: <a href="https://www.facebook.com/isc.ctu.prague" target="_blank" rel="noopener">isc.ctu.prague</a></p>
                <p class="text-align-center"><a href="https://www.google.com/maps/place/International+Student+Club+CTU+in+Prague/@50.084071,14.4119155,14z/data=!4m5!1m2!2m1!1sinternational+student+club+ctu+in+prague!3m1!1s0x470b953c0f37a36f:0x6d538d168df03b66" target="_blank" rel="noopener"> <button type="button" class="btn btn-primary">Najdi nás na mapě</button></a></p>
            </div>
            <div class="col-sm-4">
                <h3>CHCEŠ TO ZAŽÍT TAKY?</h3>
                <p class="text-align-center">
                    Dozvědět se o nás víc? Napiš nám nebo se v ISC rovnou stav! Můžeš také nakouknout do ISC Spirit Booku,
                    kde zjistíš víc o tom, v čem je ISC výjimečné. Naše kultura totiž stojí na jistých hodnotách,
                    které všichni sdílíme a ty odrážejí to jak mezi sebou komunikujeme, jak se k sobě chováme a jak spolupracujeme.
                </p>
                <p class="text-align-center">
                    <a href="{{ asset('files/iscCtuSpiritBook.pdf') }}">
                        <button type="button" class="btn btn-default">ISC Spirit Book (PDF)</button>
                    </a>
                </p>
            </div>

        </div>
    </div>
</div>

<!-- ============================= FAQ ====================================== -->
<div class="container-fluid faq" id="faq">
    <div class="container">
        <div class="row">
            <h2>ČASTO KLADENÉ OTÁZKY</h2>
            <ul id="questions" class="list-unstyled">
                <li id="q1"><a data-toggle="collapse" data-parent="q1" href="#collapseQ1">Jak se stát buddym?</a>
                    <p id="collapseQ1" class="panel-collapse collapse">Stačí se
                        <a href="{{ action('Auth\RegisterController@showRegistrationForm') }}"><button type="button" class="btn btn-primary btn-xs">zaregistrovat</button></a>
                        <!--<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-registration">zaregistrovat</button> -->
                        Po spuštění buddy programu pak emailem obdržíš přístup do databáze, kde si můžeš vybrat zahraničního studenta.</p>
                <li id="q2"><a data-toggle="collapse" data-parent="q2" href="#collapseQ2">Můžu mít zahraňáka, i když moje angličtina není moc dobrá?</a>
                    <p id="collapseQ2" class="panel-collapse collapse">Bez obav! Být součástí Buddy Programu je skvělá příležitost, jak si zlepšit cizí jazyk.
                        Tak neváhej a
                        <a href="{{ action('Auth\RegisterController@showRegistrationForm') }}"><button type="button" class="btn btn-primary btn-xs">zaregistruj se</button></a></p>
                </li>
                </li>
                <li id="q3"><a data-toggle="collapse" data-parent="q3" href="#collapseQ3">Kolik si můžu vybrat zahraničních studentů?</a>
                    <p id="collapseQ3" class="panel-collapse collapse">Každý den si můžeš vybrat 1 zahraňáka.</p>
                </li>
                <li id="q4"><a data-toggle="collapse" data-parent="q4" href="#collapseQ4">Jak bude probíhat Orientation week?</a>
                    <p id="collapseQ4" class="panel-collapse collapse">Podrobný program orientation week najdou zahraňáci na našem webu v sekci
                        <a href="{{ action('Guide\PageController@showPage', ['page' => 'orientation-week']) }}"><button type="button" class="btn btn-primary btn-xs">Survival Guide</button></a><br>
                        Registrace na fakultách budou organizované ISC, nemusíš tedy zahraňáka doprovázet, jen se ujisti, že už má svůj Welcome pack.</p>
                </li>
                <li id="q5"><a data-toggle="collapse" data-parent="q5" href="#collapseQ5">Co je to Welcome pack?</a>
                    <p id="collapseQ5" class="panel-collapse collapse">Welcome pack je obálka pro každého studenta přijíždějícího na program ERASMUS nebo Bilaterální dohodu.
                        Obsahuje informační letáčky, Survival Guide, žádost o vystavení tramvajenky atd.</p>
                </li>
                </li>
                <li id="q6"><a data-toggle="collapse" data-parent="q6" href="#collapseQ6">Kde a kdy můžu Welcome pack vyzvednout a musí u toho být i zahraňák?</a>
                    <p id="collapseQ6" class="panel-collapse collapse">Welcome packy je možné vyzvednout v
                        <a href="{{ action('Web\WebController@showContacts') }}"><button type="button" class="btn btn-primary btn-xs">ISC Pointu</button></a> od středy 19. 9. 2018 denně mezi 12 a 22 hod.
                        Nejlepší je, když přijedete oba společně rovnou z letiště.</p>
                </li>


                <!--
                    <li id="q2">
                    <a data-toggle="collapse" data-parent="q2" href="#collapseQ2">Co když nemohu svého studenta vyzvednout na letišti?</a>
                    <p id="collapseQ2" class="panel-collapse collapse">
                        Nejlépe za sebe zkus najít náhradu. V případě, že se ti nikoho nepodaří sehnat, v našem
                        <a href="#"><button type="button" class="btn btn-primary btn-xs">BUDDY PROGRAMU</button></a>
                        přejdi do sekce <kbd>MOJÍ STUDENTI</kbd> a u daného studenta klikni na <kbd>NEVYZVEDNU</kbd>.
                    </p>
                </li>

                <li id="q3"><a data-toggle="collapse" data-parent="q3" href="#collapseQ3">Můj zahraniční student neodepisuje na můj první infomail. Co mám dělat?</a>
                    <p id="collapseQ3" class="panel-collapse collapse">
                    Bohužel i to se stává. Někdy student odepíše se značným zpožděním, někdy neodepíše vůbec. Zkus tedy pár dní vyčkat, napsat druhý email a pokud ani to nepomůže, tak v našem
                        <a href="#"><button type="button" class="btn btn-primary btn-xs">BUDDY PROGRAMU</button></a>
                    zaškrtni, že student nekomunikuje, a zkus si vybrat někoho jiného.
                    </p>
                </li>
                -->
                <li id="q7"><a data-toggle="collapse" data-parent="q7" href="#collapseQ7">Jak se mohu více zapojit do ISC?</a>
                    <p id="collapseQ7" class="panel-collapse collapse">
                        Napiš nám na <a href="mailto:hr@isc.cvut.cz">hr@isc.cvut.cz</a> nebo se rovnou stav do našeho
                        <a href="https://www.google.com/maps/place/International+Student+Club+CTU+in+Prague/@50.084071,14.4119155,14z/data=!4m5!1m2!2m1!1sinternational+student+club+ctu+in+prague!3m1!1s0x470b953c0f37a36f:0x6d538d168df03b66" target="_blank" rel="noopener"> <button type="button" class="btn btn-primary btn-xs">ISC Pointu</button></a>
                        Každého aktivního studenta uvítáme a možností zapojení je celá řada. Jen zajdi na
                        <a href="{{ action('Web\WebController@showHomePage') }}"> <button type="button" class="btn btn-primary btn-xs">naše stránky</button></a>
                        a uvidíš co vše děláme. </p>
                </li>
            </ul>
        </div><!-- /.row -->
    </div>
</div><!-- /.container .faq -->

<!-- footer -->
<div class="footer-wrap">
    <div class="container footer">
        <div class="row">
            <div class="col-sm-2">
                <h3>Naše projekty</h3>
                <span class="bar"></span>
                <ul class="list-unstyled">
                    <!-- <li><a href="http://www.integreat.cz">inteGREAT</a></li> -->
                    <!-- <li><a href="http://isc.cvut.cz/survivalguide">SURVIVAL GUIDE</a></li> -->
                    <!-- <li>ISC Care</li> -->
                    <li><a href="{{ action('Saf\SafController@showIndex') }}" target="_blank">S ČVUT do světa</a></li>
                </ul>
            </div>
            <div class="col-sm-2">
                <h3>Najdeš nás na</h3>
                <span class="bar"></span>
                <ul class="list-unstyled">
                    <li><a href="https://www.facebook.com/isc.ctu.prague" target="_blank" rel="noopener"><img src="{{ asset('img/buddy/fb.png') }}" width="17px"> Facebook</a></li>
                    <li><a href="https://www.instagram.com/isc.cvut/" target="_blank" rel="noopener"><img src="{{ asset('img/web/instagram.png') }}" width="17"> Instagram</a></li>
                    <li><a href="https://www.youtube.com/user/ISCCTUPrague" target="_blank" rel="noopener"><img src="{{ asset('img/buddy/youtube.png') }}" width="17px"> YouTube</a></li>
                    <li><a href="https://www.linkedin.com/company/1201189" target="_blank" rel="noopener"><img src="{{ asset('img/buddy/in.png') }}" width="17px"> LinkedIn</a></li>
                    <!-- <li><a href="http://www.flickr.com/groups/iscctu/">Flickr</a></li> -->
                </ul>
            </div>
            <div class="col-sm-2">
                <h3>Parťák Net</h3>
                <span class="bar"></span>
                <ul class="list-unstyled">
                    <li><a href="{{ action('Partak\DashboardController@index') }}" target="_blank">ParťákNet</a></li>
                </ul>
            </div>
            <div class="col-sm-6">
                <p>&copy; {{ \Carbon\Carbon::today()->year }} | International Student Club CTU in Prague, z. s.</p>
            </div>

        </div><!-- /row -->

    </div><!-- /footer -->
</div><!-- /footer-wrap -->

<!-- JavaScript files -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.fancybox.pack.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.fancybox-media.js') }}"></script>


<script>
    $(document).ready(function() {
        $(".fancybox").fancybox();

        $('.fancybox-media').fancybox({
            openEffect  : 'none',
            closeEffect : 'none',
            helpers : {
                media : {}
            }
        });

        var theLoc = $('.show-menu').position().top;
        $(window).scroll(function() {
            if (theLoc >= $(window).scrollTop()) {
                if ($('.navbar-custom').hasClass('top-nav-collapse')) {
                    $('.navbar-custom').fadeOut(300, function() {
                        $('.navbar-custom').removeClass('top-nav-collapse').show(0);
                    });
                }
            } else {
                if (!$('.navbar-custom').hasClass('top-nav-collapse')) {
                    $('.navbar-custom').hide(0).addClass('top-nav-collapse').fadeIn(600);
                }
            }
        });
    });

    $('.link').on('click', function(e) {
        e.preventDefault();
        var id = $(this).attr('href');
        var eventDiv = $(id);
        var pos = eventDiv.position().top;
        $("html, body").animate({
            scrollTop: pos
        });
        return false;
    });
</script>
<script>
    function sendForm(form) {
        ajax("register-email", callBack, {email: form.email.value});
    }

    function callBack(data) {
        element = document.getElementById("msgs");
        if (data.status) {
            $(".form-body").hide(300);
            element.className = "btn btn-block btn-success";
            element.innerHTML = "<p class=\"bigger\"><span class=\"glyphicon glyphicon-ok\"></span> Registrace proběhla úspěšně</p><p>Na email ti byly odeslány informace s dalším postupen.<br>V případě, že ti email nedorazil, napiš na buddy@isc.cvut.cz</p>";
        } else {


            element.className = "btn btn-block btn-danger";
            element.innerHTML = data.message;
        }

    }

    function ajax(action, cb, data) {
        if (window.ActiveXObject) {
            httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
        } else {
            httpRequest = new XMLHttpRequest();
        }
        httpRequest.open("POST", "/muj-buddy/ajax/" + action, true);
        httpRequest.setRequestHeader("X-Requested-With", "XMLHttpRequest");
        httpRequest.setRequestHeader("Content-type", "application/json")
        httpRequest.onreadystatechange = function() {
            processRequest(cb);
        };
        httpRequest.send(JSON.stringify(data));
    }

    function processRequest(cb) {
        if (httpRequest.readyState == 4 && httpRequest.status == 200) {
            cb(JSON.parse(httpRequest.responseText));
        }
    }
</script>
</body>
</html>
