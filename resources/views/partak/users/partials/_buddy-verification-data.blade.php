@if($buddy->motivation)
    <p class="mb-0"><strong>Motivation:</strong> {{ $buddy->motivation }}</p>
@elseif(hash_equals($buddy->user->email ?? "", $buddy->verification_email ?? ""))
    <p class="mb-0">{{ $buddy->person->first_name }} has used university e-mail for registration</p>
@elseif($buddy->verification_email)
    <p class="mb-0">{{ $buddy->person->first_name }} has entered university e-mail for verification: {{ $buddy->verification_email }}</p>
@else
    <p class="mb-0">{{ $buddy->person->first_name }} has not yet filled either a university e-mail or motivation</p>
@endif
