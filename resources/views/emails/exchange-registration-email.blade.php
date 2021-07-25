<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $subject }}</title>
</head>
<body>
<p>
    Hi {{ $exchangeStudent->person->first_name }}!
</p>

<p>
    It's only a few weeks until your arrival and we are doing our best to set up the Buddy programme for you!<br>
    But we need your input now!
</p>

<p>
    To register to the Buddy programme, please fill out the
    <a href="{{ route('exchange.show', [$exchangeStudent->user->hash]) }}">following form</a>.<br>
    <small>{{ route('exchange.show', [$exchangeStudent->user->hash]) }}</small>
</p>

<p>
    <strong>
        That link is unique, just for you – please keep it for eventual future updates.
    </strong>
</p>

<p>
    Please note that it's <strong>very important to complete the form</strong> in order
    <strong>to get a Buddy</strong>. The information you include will be later shared with Czech
    Buddies, and they will choose based on the <strong>time of your arrival</strong> (their time
    constraints) and the things you might have in common.
</p>

<p>
    You can write something about your <strong>hobbies</strong>, about your <strong>field of study</strong>,
    or what do you expect from your stay in Prague :). If you're coming together with some friends,
    please mention that too – it makes the planning much easier for us.
</p>

<p>
    Please note that we're not able to guarantee that everyone gets their Czech Buddy
    (we're all volunteers after all), but by filling out the form properly and by attaching a photo
    you will have a pretty high chance to get one.
</p>

<p>
    After being paired with your Buddy, he or she will contact you.
    Please be patient – this might take a few days/weeks.
</p>

<p>
    <small>
        If (for any reason) you don't wish to have a Czech Buddy, you can take your name out of the
        Buddy programme by checking the "I don't wish to have a Buddy" option in the form.<br>
        But remember that taking part in the Buddy programme is the best way to meet Czech people,
        learn something about us and our culture and, above all, it can make your first days
        in Prague significantly easier.
    </small>
</p>

<p>
    You can find more information about the {{ $fullName }} and our activities on our
    <a href="{{ route('web.lang-select') }}">website</a>.
    And if you have any questions, feel free to ask at <a href="mailto:buddy@isc.cvut.cz">buddy@isc.cvut.cz</a>
</p>

<p>
    Thank you and see you in Prague!
</p>

<p>
    Volunteers of {{ $fullName }}
</p>

<p>
    <a href="{{ route('web.lang-select') }}">Web</a>: {{ route('web.lang-select') }}<br>
    <a href="{{ $fbPageUrl }}">FB page</a>: {{ $fbPageUrl }}<br>
    <a href="{{ Settings::get('fbGroupLink') }}/">FB group</a>: {{ Settings::get('fbGroupLink') }}<br>
    <a href="{{ Settings::get('whatsAppAnnoucementsLink') }}">WhatsApp Announcements group</a>: {{ Settings::get('whatsAppAnnoucementsLink') }}<br>
    <a href="{{ Settings::get('whatsAppGeneralLink') }}">WhatsApp General group</a>: {{ Settings::get('whatsAppGeneralLink') }}<br>
    <a href="{{ $igProfileUrl }}">Instagram</a>: {{ $igProfileUrl }}
</p>

<p>
    This <a href="{{ route('privacy.notice') }}">Privacy notice</a> is to let you know how we promise to look after your personal information.<br>
    <small>{{ route('privacy.notice') }}</small>
</p>
</body>
</html>
