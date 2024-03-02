Nový Buddy bez ČVUT adresy

Ahoj, zaregistroval se nám Buddík, který bohužel nemá univerzitní e-mail.
Ověř proto, prosím, jestli se nejedná o ďábla, a případně mu přiřaď roli Buddíka.

Jméno: {{ $buddy->person->first_name }} {{ $buddy->person->last_name }}
E-mail: {{ $buddy->person->user->email }}
Motivace:
{{ $buddy->motivation }}

Pro schválení/zamítnutí přejdi, prosím, na ParťákNet: {{ route('partak.users.buddies.show', ['buddy' => $buddy]) }}

Believe in ISC Spirit. Pass it on.
Duch ISC.


Tento e-mail odeslal kybernetický klon Ducha ESN, kterého do kódu implementoval tvůrce ParťákNetu.
