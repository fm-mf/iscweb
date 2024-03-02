Hi {{ $exchangeStudent->person->first_name }},

we hope you’re looking forward to your study abroad in Prague!
The Buddy database, where CTU students will be able to chose their international Buddies
will be open from {{ $buddyDbFrom->format('l, j F Y') }} and since you haven’t filled out your registration form,
we would just like to remind you that now it is the right time to do it.

So if you want to take an advantage of having a local Buddy
who can make your first days in Prague significantly easier,
hurry up! Just click on the following link and fill in
some information about you:
{{ route('exchange.show', [$exchangeStudent->user->hash]) }}

You can also take your name out of the Buddy programme by checking the
‘I don’t wish to have a buddy’. Just keep in mind that taking part
in the Buddy programme is the best way to meet Czech people
and learn something about us and our culture.

We look forward to seeing you soon in Prague,
Volunteers of {{ $fullName }}

Web: {{ route('web.lang-select') }}
FB page: {{ $fbPageUrl }}
{{--FB group: {{ Settings::get('fbGroupLink') }}--}}
{{--WhatsApp Announcements group: {{ Settings::get('whatsAppAnnoucementsLink') }}--}}
{{--WhatsApp General group: {{ Settings::get('whatsAppGeneralLink') }}--}}
{{--Discord: {{ $exchangeDiscordLink }}--}}
Instagram: {{ $igProfileUrl }}

This Privacy notice is to let you know how we promise to look after your personal information:
{{ route('privacy.notice') }}
