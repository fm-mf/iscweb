<!DOCTYPE html>
<html lang="cs">
    <head>
        <meta charset="UTF-8" />
        <title>Nový buddy bez ČVUT adresy</title>
        <style>
            .approve {
                color: #ffffff;
                background-color: #008000;
                padding: 1rem;
                font-size: 1rem;
            }
            .deny {
                color: #ffffff;
                background-color: #df0000;
                padding: 1rem;
                font-size: 1rem;
            }
        </style>
    </head>
    <body>
        <h1>Nový buddy bez ČVUT adresy</h1>
        <p>Ahoj, zaregistroval se nám buddík, který bohužel nemá univerzitní e-mail. Proto,
            prosím, ověř, jestli se nejedná o ďábla, a případně mu přiřaď roli buddíka.</p>
        <dl>
            <dt>Jméno</dt>
            <dd>{{ $buddy->person->first_name }} {{ $buddy->person->last_name }}</dd>
            <dt>E-mail</dt>
            <dd>{{ $buddy->person->user->email }}</dd>
            <dt>Motivace</dt>
            <dd>{{ $buddy->motivation }}</dd>
        </dl>
        <p>
            <a class="approve" href="{{ url('/partak/users/buddies/approve/' . $buddy->id_user) }}">Scvhálit</a>
            <a class="deny" href="{{ url('/partak/users/buddies/deny/' . $buddy->id_user) }}">Zamítnout</a>
        </p>
        <p>Believe in ISC Spirit. Pass it on.<br>
            Duch ISC.
        </p>
        <small>Tento e-mail odeslal kybernetický klon Ducha ISC, kterého do kódu implementoval tvůrce ParťákNetu.</small>
    </body>
</html>
