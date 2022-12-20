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
    It's only a few weeks until your arrival, and we are doing our best to set up the Buddy programme for you!<br>
    This is the time when we need your input.
</p>

<p>
    To register to the Buddy programme, please fill out the
    <a href="{{ route('exchange.show', [$exchangeStudent->user->hash]) }}">following form</a>.
</p>

<p>
    <strong>
        That link is unique, just for you – please keep it for eventual future updates.
    </strong>
</p>

<p>
    <strong>Completing the form</strong> is necessary in order to get a Buddy. <br>
    You can fill out the date of your arrival and type of accommodation you will be staying at (dorm/private).
    In the "About yourself" section, you can write something about your <strong>hobbies</strong>, your
    <strong>field of study</strong>, or what do you expect from your stay in Prague :). If you're coming together with
    some friends, please mention that too – it makes the planning much easier for us.
</p>

<p>
    The information you include will be later shared with our local Buddies. They usually choose their International Buddy
    based on the <strong>time of your arrival</strong> (their time constraints), <strong>similar hobbies</strong>, or
    the things you might have in common. <br>
    <strong>Filling up your profile</strong> with all the information and <strong>attaching a photo</strong>
    will give you a pretty high chance of getting a Buddy. <br>
</p>

<p>
    Please note that we're not able to guarantee that everyone gets their Buddy
    (we're all volunteers after all), but a properly filled out profile can greatly increase your chances of getting
    one.
</p>

<p>
    After being paired with your Buddy, he or she will contact you.
    Please be patient – this might take a few days/weeks.
</p>

<p>
    <small>
        If (for any reason) you don't wish to have a Buddy, you can opt out of the
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
    {{-- <a href="{{ Settings::get('fbGroupLink') }}/">FB group</a>: {{ Settings::get('fbGroupLink') }}<br>--}}
    {{-- <a href="{{ Settings::get('whatsAppAnnoucementsLink') }}">WhatsApp Announcements group</a>: {{
    Settings::get('whatsAppAnnoucementsLink') }}<br>--}}
    {{-- <a href="{{ Settings::get('whatsAppGeneralLink') }}">WhatsApp General group</a>: {{
    Settings::get('whatsAppGeneralLink') }}<br>--}}
    <a href="{{ Settings::get('esnPragueDiscord') }}/">Discord</a>: {{ Settings::get('esnPragueDiscord') }}<br>
    <a href="{{ $igProfileUrl }}">Instagram</a>: {{ $igProfileUrl }}
</p>

<p>
    This <a href="{{ route('privacy.notice') }}">Privacy notice</a> is to let you know how we promise to look after your
    personal information.
</p>
</body>
</html>
