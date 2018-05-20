<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Zásady ochrany osobních údajů | ISC CTU in Prague</title>
        <link rel="icon" type="image/vnd.microsoft.icon" href="{{ asset('img/favicon.ico') }}" sizes="16x16 32x32 64x64"/>
        <link href="{{ URL::asset('css/login.css') }}" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="privacy-wrapper">
            <div class="center">
                {{ Form::open(['url' => '/privacy/partak']) }}
                <h2>Zásady ochrany osobních údajů v systému ParťákNET</h2>
                <p>
                    Pomocí ParťákNETu je za určitých okolností získat přístup k některým osobním údajům
                    o českých studentech (&bdquo;Buddících&ldquo;) i zahraničních studentech (&bdquo;Zahraňácích&ldquo;).
                    Tyto údaje je potřeba chránit a zacházet s nimi tak, jak zákon nařizuje.
                    Je několik pravidel, které se k práci s těmito údaji vztahují:
                </p>
                <ul>
                    <li>je potřeba zabránit neoprávněným osobám přistupovat k osobním údajům a k prostředkům pro jejich zpracování, tedy ParťákNETu,</li>
                    <li>je potřeba zabránit neoprávněnému čtení, vytváření, kopírování, přenosu, úpravě či vymazání záznamů obsahujících osobní údaje z ParťákNETu,</li>
                    <li>je potřeba zabránit zneužití záznamů obsahujících osobní údaje z ParťákNETu,</li>
                    <li>je potřeba zabránit použití záznamů obsahujících osobní údaje k jiným účelům, než který je uveden v ParťákNETu.</li>
                </ul>
                <p>
                    Tato pravidla se vztahují i na všechny údaje získané z ParťákNETu, jako jsou vyexportované tabulky,
                    seznamy atd. Obdobná pravidla se vztahují i na ostatní systémy ISC.
                </p>
                <p>
                    Kliknutím na tlačítko &bdquo;Rozumím a souhlasím&ldquo; se zavazuješ k dodržovování těchto pravidel.
                    Nejde o nic převratného, ale je lepší si to vyjasnit. Pokud nesouhlasíš a odmítneš,
                    přístup do ParťákNETu ti bude omezen.
                </p>
                {{ Form::bsSubmit('Rozumím a souhlasím') }}

                {{ Form::close() }}
            </div>
        </div>
    </body>
</html>
