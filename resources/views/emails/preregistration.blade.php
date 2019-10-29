<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>You've registered for {{ $event->name }}</title>
    </head>
    <body>
        <p>Hi,</p>
        <p>
            You've successfully registered for {{ $event->name }}.
            Now you have <strong>{{ $event->preregistration_removal_limit }} days</strong> to go to <a href="https://isc.cvut.cz/contact" target="_blank">ISC Point</a> and pay to confirm your spot.
            If you don't confirm your spot in {{ $event->preregistration_removal_limit }} days, your registration will be cancelled.
        </p>
        <p>If you can't participate and you didn't already confirm your registration, please use following link to cancel it: <strong><a href="{{ url("/event/{$event->preregistration_hash}/cancel/{$response->hash}") }}">CANCEL</a></strong>. If you've already confirmed your registration, contact organizers or ISC to let them know you're not coming.</p>
        <p>Details about the trip:</p>
        <p>
            <strong>When:</strong> {{ $event->trip->eventDateInterval(false) }}<br />
            <strong>Where:</strong> <a href="{{ $event->location_url }}" target="_blank">{{ $event->location }}</a><br />
            <strong>Price:</strong> @if ($event->price) {{ $event->price }} CZK @else FREE @endif<br />
            <strong>Description:</strong> <a href="{{ url("/event/{$event->preregistration_hash}") }}">here</a>
        </p>
        <p>Your ISC CTU in Prague</p>
        <img src="{{ asset('img/logos/isc-esn-email-signature.png') }}" width="250" />
    </body>
</html>