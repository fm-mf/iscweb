<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => 'Tyto přihlašovací údaje neodpovídají žádnému záznamu.',
//    'password' => 'Zadané heslo není správné.',
    'throttle' => 'Příliš mnoho pokusů o přihlášení. Zkuste to prosím znovu za :seconds vteřin.',

    'registered-before' => 'Dříve než :date',
    'long-time-ago' => 'Dávno',

    'login' => 'Přihlášení',
    'log-in' => 'Přihlásit se',
    'log-in-ctu' => 'Přihlásit se pomocí ČVUT účtu',
    'log-out' => 'Odhlásit se',

    'ctu-symbol' => 'Symbol ČVUT',

    'login-heading-buddy' => 'Přihlášení do Buddy programu',
    'login-heading-partak' => 'Přihlášení na ParťákNet',

    'e-mail' => 'E-mailová adresa',
    'password' => 'Heslo',
    'password-confirmation' => 'Heslo znovu',
    'remember-login' => 'Zapamatovat přihlášení',

    'no-account-yet' => 'Ještě nemáš účet?',
    'register-imp' => 'Zaregistruj se!',
    'forgot-your-password' => 'Zapomněl/a jsi heslo',

    'registration' => 'Registrace',
    'register' => 'Zaregistrovat se',
    'register-with-ctu' => [
        'btn-title' => 'Zaregistrovat se pomocí ČVUT účtu',
        'notice' => '
            Kliknutím na tlačítko „:btnTitle“ slibuješ, že se budeš držet <a href=":hrefCode">Buddy kodexu</a>
            a souhlasíš se <a href=":hrefPrivacy" target="_blank" title="Souhlas se zpracováním osobních údajů">zpracováním osobních údajů</a>.
        ',
    ],
    'registration-heading' => 'Registrace do Buddy programu',
    'registration-info' => '
        <p>
            Registrací získáš přístup do databáze přijíždějících výměnných zahraničních studentů.
        </p>
        <p>
            V případě, že ses již registroval(a), pokračuj na
            <a href=":href">přihlašovací stránku</a>.
        </p>
    ',

    'password-note' => 'Heslo musí mít alespoň 8 znaků',
    'privacy-approval' => 'Souhlasím se <a href=":href" target="_blank" title="Souhlas se zpracováním osobních údajů">zpracováním osobních údajů</a>.',

    'placeholder' => [
        'e-mail' => 'Zadej svou e-mailovou adresu',
        'password' => 'Zadej své heslo',
        'password-confirmation' => 'Potvrď své heslo',
    ],

    'register-check' => [
        'label' => 'Pro pokračování, prosím, zvol příslušnou možnost:',
        'label-local' => ' Jsem <strong>místní (český) student</strong> a chci se stát Buddym a pomáhat zahraničním studentům.',
        'label-exchange' => 'Jsem <strong>výměnný zahraniční student</strong> a rád bych dostal Buddyho.',
        'label-degree-student' => 'Jsem <strong>nově přijíždějící zahraniční student na celé studium</strong> a rád bych <strong>dostal Buddyho.</strong>',
        'label-degree-buddy' => 'Jsem <strong>zahraniční student na celé studium</strong> a rád bych se <strong>stal Buddym</strong> a pomohl novým studentům.',
        'continue' => 'Pokračovat …',
        'exchange' => 'Výměnný zahraniční student',
        'degree' => 'Zahraniční student na celé studium',
    ],

    'profile' => [
        'title' => 'Můj profil',
        'info' => '
            <p>
                Tyto údaje jsou nepovinné. Jejich vyplnění nám však může ušetřit spoustu práce v případě, že nastanou problémy.
            </p>
        ',
        'basic-information' => 'Základní údaje',
        'email-info' => '
            Na této e-mailové adrese tě budeme v případě potřeby kontaktovat.
            Pokud si ji přeješ změnit, kontaktuj nás na
        ',
        'given-names' => 'Jméno',
        'surname' => 'Příjmení',
        'additional-information' => 'Doplňující údaje',
        'sex' => 'Jsem',
        'sex-m' => 'Muž',
        'sex-f' => 'Žena',
        'year-of-birth' => 'Rok narození',
        'country' => 'Země původu',
        'faculty' => 'Fakulta',
        'phone' => 'Telefonní číslo',
        'about-me' => 'O mě',
        'newsletter' => 'Odběr novinek',
        'newsletter-approval' => '
            Souhlasím s občasným zasíláním informačních e-mailů o dění v ESN
            (např. informace o otevření Buddy databáze či o důležitých nadcházejících akcích).
        ',

        'update' => 'Aktualizovat profil',
        'skip-to-verification' => 'Přejít na ověření',
        'skip-profile' => 'Přeskočit …',

        'updated-successfully' => 'Tvůj profil byl úspěšně aktualizován.',

        'placeholder' => [
            'given-names' => 'Zadej své jméno',
            'surname' => 'Zadej své příjmení',
            'sex' => 'Vyber pohlaví …',
            'year-of-birth' => 'Zadej rok svého narození',
            'country' => 'Vyber zemi, odkud jsi …',
            'faculty' => 'Vyber fakultu, na které studuješ …',
            'phone' => 'Zadej své telefonní číslo',
            'about-me' => 'Napiš něco o sobě …',
        ],
    ],

    'verification' => [
        'title' => 'Ověření',
        'info' => '
            <p>
                Děkujeme Ti za registraci do Buddy programu!
            </p>
            <p>
                Protože dbáme na bezpečí našich zahraničních studentů, bude teď potřeba ověřit Tvou identitu.
                K ověření je možné použít univerzitní e-mailovou adresu na kterou ti zašleme odkaz pro aktivaci účtu.
            </p>
            <p>
                V případě, že nejsi studentem žádné z níže uvedených vysokých škol, nám, prosím, zanech
                vzkaz prostřednictvím formuláře níže, a my se Ti co nejdříve ozveme s dalším postupem.
            </p>
        ',
        'with-email' => 'Mám univerzitní e-mail',
        'without-email' => 'Nemám univerzitní e-mail',
        'university-email' => 'Univerzitní e-mailová adresa',
        'university-email-help' => 'Zadej pouze část univerzitní e-mailové adresy před „@“',
        'domain' => 'Doména univerzitního e-mailu',
        'domain-help' => 'Vyber příslušnou doménu univerzitního e-mailu',
        'motivation' => 'Motivace',
        'motivation-info' => '
            <p>
                Buddym se samozřejmě můžeš stát i pokud již studentem nejsi.
                V tom případě Tě poprosíme, abys nám níže zanechal/a krátký vzkaz.
            </p>
            <p>
                Brzy se Ti ozveme s dalším postupem.
            </p>
        ',

        'send-link' => 'Zaslat ověřovací odkaz',
        'send' => 'Odeslat',

        'mail-sent' => 'E-mail s ověřovacím odkazem byl odeslán na :email.',

        'invalid-hash' => '
            <p>
                Ooops. Použitý ověřovací odkaz není platný. Zkontroluj prosím,
                jestli opravdu koresponduje s doručeným odkazem, a případně nás kontaktuj na
                <a href="mailto:buddy@esn.cvut.cz">buddy@esn.cvut.cz</a>.
            </p>
            <p>
                Omlouváme se za komplikace. :)
            </p>
        ',

        'placeholder' => [
            'university-email' => 'Zadej část e-mailové adresy před „@“',
            'domain' => 'Vyber příslušnou doménu …',
            'motivation' => 'Napiš krátce, proč se chceš stát Buddym …',
        ],
    ],

    'thanks' => [
        'heading' => 'Děkujeme za registraci do Buddy programu!',
        'verified' => '
            <p>Ověření bylo úspěšné.</p>
            <p>Nyní už si můžeš vybrat svého prvního zahraničního studenta. Přejeme ti spoustu zábavy!</p>
            <p>Do databáze zahraničních studentů se dostaneš přes odkaz <a href=":href">:href</a>.</p>
        ',
        'not-verified' => '
            <p>Děkujeme za odpověď. Brzy se Ti ozveme. Zatím se můžeš kouknout na chystané akce, kde tě rádi uvidíme!</p>
            <p>Vše najdeš v <a href=":href">kalendáři</a>.</p>
        ',
        'survey-request' => '
            <p>Jestli máš chvíli, tak oceníme, když vyplníš tento krátký anonymní formulář.</p>
            <p>Díky!</p>
        ',
    ],

    'code-of-conduct' => [
        'approval' => 'Slibuji, že se budu držet Buddy kodexu.',
        'title' => 'Buddy kodex',
        'text' => '
            <p>
                Ke své úloze se stavíme zodpovědně a zahraničním studentům se snažíme pomáhat –
                to však neznamená, že jsme jejich sluhy. Naše vztahy by měly být převážně
                kamarádské. Zároveň si však uvědomujeme, že naše jednání ovlivňuje pověst ESN,
                ČVUT a potažmo celé České republiky. Proto se chováme tak, abychom ji nepoškozovali.
            </p>
            <p>
                Nebojíme se komunikovat i v případě, že cizí jazyky nejsou naší silnou
                stránkou. Naopak, v poznávání zahraničních studentů vidíme obrovskou
                příležitost a sami se od nich chceme něco naučit. V žádném případě je však
                nezneužíváme k vlastnímu prospěchu, ani ke komerčním účelům.
            </p>
            <p>
                Stává se, že si s nějakou situací nevíme rady. Jsme však jeden tým, a vždy
                se můžeme obrátit na ESN s žádostí o pomoc
                (<a href="mailto:buddy@esn.cvut.cz">buddy@esn.cvut.cz</a>).
            </p>
        ',
    ],

    'passwords' => [
        'title' => 'Obnovení hesla',
        'reset' => 'Obnovit heslo',
        'send-link' => 'Poslat odkaz pro obnovu hesla',
    ],

];
