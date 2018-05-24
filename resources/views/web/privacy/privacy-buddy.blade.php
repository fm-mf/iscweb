<!DOCTYPE html>
<html lang="cs">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Zásady ochrany osobních údajů | ISC CTU in Prague</title>
        <link rel="icon" type="image/vnd.microsoft.icon" href="{{ asset('img/favicon.ico') }}" sizes="16x16 32x32 64x64"/>
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/login.css') }}">
    </head>
    <body>
        <div class="privacy-wrapper">
            <div class="center">
                {{ Form::open(['action' => 'Privacy\PrivacyController@privacyBuddy']) }}
                <h2>Zásady ochrany osobních údajů v Buddy programu</h2>
                <p>
                    Pomocí Buddy programu lze získat přístup k některým osobním údajům o zahraničních studentech.
                    Tyto údaje je potřeba chránit a zacházet s nimi tak, jak zákon nařizuje.
                    Je několik pravidel, které se k práci s těmito údaji vztahují:
                </p>
                <ul>
                    <li>je potřeba zabránit neoprávněným osobám přistupovat k osobním údajům a k prostředkům pro jejich zpracování, tedy systému Buddy programu,</li>
                    <li>je potřeba zabránit neoprávněnému čtení, vytváření, kopírování, přenosu, úpravě či vymazání záznamů obsahujících osobní údaje z Buddy programu,</li>
                    <li>je potřeba zabránit zneužití záznamů obsahujících osobní údaje z Buddy programu,</li>
                    <li>je potřeba zabránit použití záznamů obsahujících osobní údaje k jiným účelům, než kterým slouží Buddy programu.</li>
                </ul>
                <p>
                    Tato pravidla se vztahují i na všechny údaje získané z Buddy programu. Obdobná pravidla se vztahují i na ostatní systémy ISC.
                </p>
                <p>
                    Kliknutím na tlačítko &bdquo;Rozumím a souhlasím&ldquo; se zavazuješ k dodržovování těchto pravidel.
                    Nejde o nic převratného, ale je lepší si to vyjasnit. Pokud nesouhlasíš a odmítneš, přístup do Buddy programu ti bude omezen.
                </p>
                {{ Form::bsSubmit('Rozumím a souhlasím') }}

                {{ Form::close() }}
            </div>
        </div>
    </body>
</html>
