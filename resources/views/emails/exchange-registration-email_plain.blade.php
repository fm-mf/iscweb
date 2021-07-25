Hi {{ $exchangeStudent->person->first_name }}!

It's only a few weeks until your arrival and we are doing our best to set up the Buddy programme for you!
But we need your input now!

To register to the Buddy programme, please fill out the following form:
{{ route('exchange.show', [$exchangeStudent->user->hash]) }}

That link is unique, just for you – please keep it for eventual future updates.

Please note that it's very important to complete the form in order
to get a Buddy. The information you include will be later shared with Czech
Buddies, and they will choose based on the time of your arrival (their time
constraints) and the things you might have in common.

You can write something about your hobbies, about your field of study,
or what do you expect from your stay in Prague :). If you're coming together with some friends,
please mention that too – it makes the planning much easier for us.

Please note that we're not able to guarantee that everyone gets their Czech Buddy
(we're all volunteers after all), but by filling out the form properly and by attaching a photo
you will have a pretty high chance to get one.

After being paired with your Buddy, he or she will contact you.
Please be patient – this might take a few days/weeks.

If (for any reason) you don't wish to have a Czech Buddy, you can take your name out of the
Buddy programme by checking the "I don't wish to have a Buddy" option in the form.
But remember that taking part in the Buddy programme is the best way to meet Czech people,
learn something about us and our culture and, above all, it can make your first days
in Prague significantly easier.

You can find more information about the {{ $fullName }} and our activities on our website:
{{ route('web.lang-select') }}
And if you have any questions, feel free to ask us at buddy@isc.cvut.cz.

Thank you and see you in Prague!

Volunteers of {{ $fullName }}

Web: {{ route('web.lang-select') }}
FB page: {{ $fbPageUrl }}
FB group: {{ Settings::get('fbGroupLink') }}
WhatsApp Announcements group: {{ Settings::get('whatsAppAnnoucementsLink') }}
WhatsApp General group: {{ Settings::get('whatsAppGeneralLink') }}
Instagram: {{ $igProfileUrl }}

This Privacy notice is to let you know how we promise to look after your personal information:
{{ route('privacy.notice') }}
