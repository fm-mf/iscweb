<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Your reservation for {{ $event->name }} was cancelled</title>
    </head>
    <body>
        <p>Hi,</p>
        <p>
            Because you didn't confirm your reservation in time, your reservation for {{ $event->name }} was cancelled.
        </p>
        <p>With kind regards</p>
        <p>ISC CTU in Prague</p>
        <img src="{{ asset('img/logos/isc-esn-email-signature.png') }}" width="250" />
    </body>
</html>