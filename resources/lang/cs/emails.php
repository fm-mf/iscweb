<?php

return [
    'verification' => [
        'title' => 'Buddy program ISC CTU in Prague',
        'subject' => 'Buddy program – Dokončení registrace',
        'body' => '
            <p>Ahoj!</p>
            <p>Děkujeme ti za registraci do Buddy Programu.</p>
            <p>
                Pro přístup do databáze zahraničních studentů klikni na následující odkaz:<br />
                <a href=":url" target="_blank">Ověřit e-mail</a>,<br />
                případně zkopíruj do adresního řádku prohlížeče následující odkaz:<br />
                <span style="user-select: all">:url</span>.
            </p>
        ',
    ],
    'welcome' => [
        'title' => 'Vítej v Buddy programu!',
        'subject' => 'Vítej v Buddy programu',
        'body' => '
            <p>Jsme moc rádi, že ses rozhodl/a zapojit do mezinárodní komunity na ČVUT!</p>
            <p>Do Buddy Databáze se dostaneš <a href=":buddyDbUrl">zde</a>.</p>
            <p>
                Přidej se také do FB skupiny <a href="https://www.facebook.com/groups/isc.ctu.buddies/">ISC CTU Czech Buddies</a>,
                kde získáš nejčerstvější novinky.
                A co se týká ostatních informací o ISC a všech akcích,
                sleduj i naší FB stránku <a href="https://www.facebook.com/isc.ctu.prague/">ISC CTU in Prague</a>.
                Pokud bys měl/a jakékoliv dotazy, neváhej se zeptat ve FB skupině <em>Czech Buddies</em>
                nebo kontaktovat našeho Buddy koordinátora na e-mailu <a href="mailto:buddy@isc.cvut.cz">buddy@isc.cvut.cz</a>.
            </p>
            <p>Přejeme hodně štěstí při vybírání „zahraňáka“. :)</p>
            <p>ISC Buddy team</p>
        ',
    ],
];
