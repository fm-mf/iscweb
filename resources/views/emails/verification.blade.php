<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>ISC CTU Buddy program</title>
</head>
<body>
Ahoj!
Děkujeme za registraci do Buddy Programu.
Pro přístup do databáze zahraničních studentů klikni na následující odkaz: <br>
<a href="{{ url('user/verify/' . $person->user->hash) }}">{{ url('user/verify/' . $person->user->hash) }}</a>

</body>
</html>