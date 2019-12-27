<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>You've reserved your spot for {{ $event->name }}</title>
    </head>
    <body>
        <p>Hi,</p>
        @if ($event->ow)
            <p>
                You've successfully reserved your spot for {{ $event->name }}. Now go to trip stand and confirm your spot
                by paying the trip price. If you don't do this, your reservation will be cancelled!
            </p>
        @else
            <p>
                You've successfully reserved your spot for {{ $event->name }}.
                Now you have until <strong>{{ $response->expirationDate() }}</strong> to go to <a href="https://isc.cvut.cz/contact" target="_blank">ISC Point</a> and pay to confirm your spot.
                If you don't confirm your spot until {{ $response->expirationDate() }}, your reservation will be cancelled.
            </p>
            <p>If you can't participate and you didn't already confirm your reservation, please use following link to cancel it:</p>
            <p><strong><a href="{{ url("/event/{$event->reservations_hash}/cancel/{$response->hash}") }}">Cancel reservation</a></strong></p>
            <p>If you've already confirmed your reservation, contact organizers or ISC to let us know you're not coming.</p>
        @endif

        <p>Details about the trip:</p>
        <p>
            <strong>When:</strong> {{ $event->trip->eventDateInterval(false) }}<br />
            <strong>Where:</strong> <a href="{{ $event->location_url }}" target="_blank">{{ $event->location }}</a><br />
            <strong>Price:</strong> @if ($event->price) {{ $event->price }} CZK @else FREE @endif<br />
            <strong>Description:</strong> <a href="{{ url("/event/{$event->reservations_hash}") }}">here</a>
        </p>
        <p>With kind regards</p>
        <p>ISC CTU in Prague</p>
        <img src="{{ asset('img/logos/isc-esn-email-signature.png') }}" width="250" />
    </body>
</html>