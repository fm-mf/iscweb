<h1>{{ $trip->event->name }} participants</h1>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Surname</th>
            <th>Given names</th>
            <th>Nationality</th>
            <th>Diet</th>
            <th>Medical issues</th>
            <th>Sex</th>
            <th>E-mail</th>
            <th>Phone</th>
            <th>WhatsApp</th>
            <th>ESNcard number</th>
            <th>Accommodation</th>
            <th>Comment to payment</th>
            <th>Paid</th>
            <th>Register By</th>
            @if ($trip->reservations_enabled)
                @foreach($trip->questions as $question)
                    <th>{{ $question->label }}</th>
                @endforeach
                <th>Reservation notes</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach($participants as $index => $participant)
            @php
                $reservation = \App\Models\EventReservation::findByUserAndEvent($participant->id_user, $trip->id_event)
                    ->withTrashed()
                    ->first();
            @endphp
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $participant->last_name }}</td>
                <td>{{ $participant->first_name }}</td>
                <td>{{ $participant->exchangeStudent->country->full_name ?? 'BUDDY'}}</td>
                <td>{{ $participant->diet ?? '–' }}</td>
                <td>{{ $participant->medical_issues }}</td>
                <td>{{ $participant->getSex() }}</td>
                <td>{{ $participant->user->email }}</td>
                <td>{{ $participant->exchangeStudent->phone_formatted ?? $participant->buddy->phone_formatted ?? ''}}</td>
                <td>{{ $participant->exchangeStudent->whats_app_formatted_international ?? ''}}</td>
                <td>{{ $participant->exchangeStudent->esn_card_number ?? '' }}</td>
                <td>{{ $participant->exchangeStudent->accommodation->full_name ?? ''}}</td>
                <td>{{ $participant->pivot->comment }}</td>
                <td>{{ $participant->pivot->paid }}</td>
                <td>{{ \App\Models\Person::find($participant->pivot->registered_by)->getFullName() }}</td>
                @if ($trip->reservations_enabled)
                    @foreach($trip->questions as $question)
                        <td>{{ $question->getAnswerDisplayByReservation($reservation->id_event_reservation) }}</td>
                    @endforeach
                    <td>{{ $reservation->notes ?? '' }}</td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>