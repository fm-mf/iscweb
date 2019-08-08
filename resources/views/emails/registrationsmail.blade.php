<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Buddy Program ISC CTU in Prague</title>
</head>
<body>
<p>Hi there!<br>
    It's a few weeks until your arrival and we are doing our best to set up the Buddy Program for you!<br>
    But we need your input now!
</p>

<p>To register for the Buddy Program, please fill out the
    <a href="{{ url('/exchange/' . $hash) }}">following form</a>.<br>
    <small>{{ url('/exchange/' . $hash) }}</small>
</p>

<p><strong>That link is unique, just for you - please keep it for eventual future updates.</strong></p>

<p>Please note that it's <strong>very important</strong> to complete the form in order to
    <strong>get a Buddy</strong>. The information you include will be later shared with Czech
    buddies, and they will choose based on the <strong>time of your arrival</strong> (their time
    constraints) and the things you might have in common. You can write something about your
    <strong>hobbies</strong>, about your <strong>field of study</strong> or what do you expect
    from your stay in Prague :). If you're coming together with some friends, please mention
    that too - that makes the planning much easier for us.</p>

<p>Also please note that we're not able to guarantee that everyone gets their Czech Buddy
    (we're all volunteers after all), but by filling out that form properly you have a pretty
    high chance to get one. After being paired with your Buddy, he or she will contact you by
    email. Please be patient; this might take a few days/weeks.</p>

<p><small>If (for any reason) you don't wish to have a Czech buddy, you can take your name out of the
    program by checking the "I don't wish to have a buddy" option in the form.<br>
    But remember that taking part in the Buddy Program is the best way to meet Czech people,
    learn something about us and our culture and, above all, it can make your first days
    in Prague significantly easier.</small>
</p>

<p>You can find more information about the International Student Club and our activities on our
    <a href="{{ url('/') }}">website</a>.
    And if you have any questions, feel free to ask at <a href="mailto:buddy@isc.cvut.cz">buddy@isc.cvut.cz</a></p>

<p>Thank you and see you in Prague!</p>

<p>Volunteers of International Student Club CTU in Prague</p>

<p><a href="{{ url('/') }}">Web</a>: {{ url('/') }}<br>
    <a href="https://www.facebook.com/isc.ctu.prague/">FB page</a>: https://www.facebook.com/isc.ctu.prague/<br>
    <a href="{{ $fbGroupLink }}/">FB group</a>: {{ $fbGroupLink }}</p>

<p>This <a href="{{ url('privacy/notice') }}">Privacy notice</a> is to let you know how we promise to look after your personal information.<br>
    <small>{{ url('privacy/notice') }}</small>
</p>
</body>
</html>
