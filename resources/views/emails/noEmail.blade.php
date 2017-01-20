<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Dobré zprávy od ducha ISC</title>
</head>
<body>
<p>Ahoj milá Pájo,<br>
Zaregistroval se nám buddík, který bohužel nemá univerzitní email. Proto prosím ověř, jestli se nejedná o dábla a případně mu přiřad roli buddíka. <br>

    Jméno: <b>{{ $buddy->person->first_name }} {{ $buddy->person->last_name }}</b><br>
    Email: <b>{{ $buddy->person->user->email }}</b></p>

<p>Jeho motivace:<br>
    {{  $motivation }}
</p>

<p>Believe in ISC Spirit. Pass it on.<br>
    Duch ISC.
</p>
<small>Tento email odeslal kybernetický klon Ducha ISC, kterého do kódu implementoval tvůrce ParťákNetu.</small>
</body>
</html>