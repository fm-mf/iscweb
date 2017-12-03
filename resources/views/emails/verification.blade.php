<!DOCTYPE html>
<html lang="cs">
    <head>
        <meta charset="UTF-8" />
        <title>ISC CTU Buddy program</title>
    </head>
    <body>
        <p>Ahoj!</p>
        <p>Děkujeme za registraci do Buddy Programu.</p>
        <p>Pro přístup do databáze zahraničních studentů klikni na následující odkaz:<br>
            <a href="{{ url('user/verify/' . $person->user->hash) }}">Ověřit</a>,<br>
            případně zkopírojte do adresního řádku prohlížeče následující odkaz:<br>
            {{ url('user/verify/' . $person->user->hash) }}</p>
    </body>
</html>