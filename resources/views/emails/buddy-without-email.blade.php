<!DOCTYPE html>
<html lang="cs">
    <head>
        <meta charset="UTF-8" />
        <title>{{ $subject }}</title>
        <style>
            dt {
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <h1>{{ $subject }}</h1>
        <p>
            Ahoj, zaregistroval se nám Buddík, který bohužel nemá univerzitní e-mail.
            Ověř proto, prosím, jestli se nejedná o ďábla, a případně mu přiřaď roli Buddíka.
        </p>
        <dl>
            <dt>Jméno</dt>
            <dd>{{ $buddy->person->first_name }} {{ $buddy->person->last_name }}</dd>
            <dt>E-mail</dt>
            <dd>{{ $buddy->person->user->email }}</dd>
            <dt>Motivace</dt>
            <dd>{{ $buddy->motivation }}</dd>
        </dl>
        <p>
            Pro schválení/zamítnutí přejdi, prosím,
            <a href="{{ route('partak.users.buddies.show', ['buddy' => $buddy]) }}" target="_blank">na ParťákNet</a>.
        </p>
        <p>
            Believe in ISC Spirit. Pass it on.<br />
            Duch ISC.
        </p>
        <p>
            <small>
                Tento e-mail odeslal kybernetický klon Ducha ESN, kterého do kódu implementoval tvůrce ParťákNetu.
            </small>
        </p>
    </body>
</html>
