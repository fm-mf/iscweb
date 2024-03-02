Hi {{ $exchangeStudent->person->first_name }}!

It's only a few weeks until your arrival, and we are doing our best to set up the Buddy programme for you!
This is the time when we need your input.

To register to the Buddy programme, please fill out the following form:
{{ route('exchange.show', [$exchangeStudent->user->hash]) }}

That link is unique, just for you – please keep it for eventual future updates.

Completing the form is necessary in order to get a Buddy. You can fill out the date of your arrival
and type of accommodation you will be staying at (dorm/private). In the "About yourself" section, you can write
something about your hobbies, your field of study, or what do you expect from your stay in Prague :). If you're coming together with
some friends, please mention that too – it makes the planning much easier for us.

The information you include will be later shared with our local Buddies. They usually choose their International Buddy
based on the time of your arrival (their time constraints), similar hobbies, or
the things you might have in common.
Filling up your profile with all the information and attaching a photo will give you a pretty high chance of getting a Buddy.


Please note that we're not able to guarantee that everyone gets their Buddy
(we're all volunteers after all), but a properly filled out profile can greatly increase your chances of getting
one.

After being paired with your Buddy, he or she will contact you.
Please be patient – this might take a few days/weeks.

If (for any reason) you don't wish to have a Buddy, you can opt out of the
Buddy programme by checking the “I don't wish to have a Buddy” option in the form.
But remember that taking part in the Buddy programme is the best way to meet Czech people,
learn something about us and our culture and, above all, it can make your first days
in Prague significantly easier.

You can find more information about the {{ $fullName }} and our activities on our website:
{{ route('web.lang-select') }}
And if you have any questions, feel free to ask us at buddy@esn.cvut.cz.

Thank you and see you in Prague!

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
