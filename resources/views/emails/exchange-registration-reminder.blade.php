<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $subject }}</title>
</head>
<body>

<p>
    Hi {{ $exchangeStudent->person->first_name }},
</p>

<p>
    we hope you’re looking forward to your study abroad in Prague!
    The Buddy database, where CTU students will be able to chose their international Buddies
    will be open from {{ $buddyDbFrom->format('l, j F Y') }} and since you haven’t filled out
    your registration form, we would just like to remind you that now it is the right time to do it.
</p>

<p>
    So if you want to take an advantage of having a local Buddy
    who can make your first days in Prague significantly easier,
    hurry up! Just click on the following link and fill in
    some information about you:
</p>

<p>
    <a href="{{ route('exchange.show', [$exchangeStudent->user->hash]) }}">
        Fill in your profile
    </a>
</p>

<p>
    <small>
        You can also take your name out of the Buddy programme by checking the
        ‘I don’t wish to have a buddy’. Just keep in mind that taking part
        in the Buddy programme is the best way to meet Czech people
        and learn something about us and our culture.
    </small>
</p>

<p>
    We look forward to seeing you soon in Prague.
</p>
<p>
    Volunteers of {{ $fullName }}
</p>

<p>
    <a href="{{ route('web.lang-select') }}">Web</a>: {{ route('web.lang-select') }}<br>
    <a href="{{ $fbPageUrl }}">FB page</a>: {{ $fbPageUrl }}<br>
{{--    <a href="{{ Settings::get('fbGroupLink') }}/">FB group</a>: {{ Settings::get('fbGroupLink') }}<br>--}}
{{--    <a href="{{ Settings::get('whatsAppAnnoucementsLink') }}">WhatsApp Announcements group</a>: {{ Settings::get('whatsAppAnnoucementsLink') }}<br>--}}
{{--    <a href="{{ Settings::get('whatsAppGeneralLink') }}">WhatsApp General group</a>: {{ Settings::get('whatsAppGeneralLink') }}<br>--}}
    <a href="{{ $exchangeDiscordLink }}">Discord</a>: {{ $exchangeDiscordLink }}<br>
    <a href="{{ $igProfileUrl }}">Instagram</a>: {{ $igProfileUrl }}
</p>

<p>
    This <a href="{{ route('privacy.notice') }}">Privacy notice</a> is to let you know how we promise to look after your personal information.<br>
    <small>{{ route('privacy.notice') }}</small>
</p>

</body>
</html>
