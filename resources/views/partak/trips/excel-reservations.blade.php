<h1>{{ $trip->event->name }} reservations</h1>
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
            @foreach($trip->questions as $question)
                <th>{{ $question->label }}</th>
            @endforeach
            <th>Reservation notes</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reservations as $index => $person)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $person->last_name }}</td>
                <td>{{ $person->first_name }}</td>
                <td>{{ $person->exchangeStudent->country->full_name ?? 'BUDDY'}}</td>
                <td>{{ $person->pivot->diet ?? '–' }}</td>
                <td>{{ $person->pivot->medical_issues }}</td>
                <td>{{ $person->getSex() }}</td>
                <td>{{ $person->user->email }}</td>
                <td>{{ $person->exchangeStudent->phone_formatted ?? $person->buddy->phone_formatted ?? ''}}</td>
                <td>{{ $person->exchangeStudent->whats_app_formatted_international ?? ''}}</td>
                <td>{{ $person->exchangeStudent->esn_card_number ?? '' }}</td>
                <td>{{ $person->exchangeStudent->accommodation->full_name ?? ''}}</td>
                @foreach($trip->questions as $question)
                    <td>{{ $question->getAnswerDisplayByReservation($person->pivot->id_event_reservation) }}</td>
                @endforeach
                <td>{{ $person->pivot->notes ?? '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>