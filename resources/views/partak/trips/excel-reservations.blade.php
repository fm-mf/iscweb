<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>

<body>
<h3 align="center">{{ $trip->event->name }} reservations</h3>
    <div class="container">
        <table align="center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Nationality</th>
                    <th>Diet</th>
                    <th>Medical issues</th>
                    <th>Sex</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>WhatsApp</th>
                    <th>ESNcard number</th>
                    <th>Accommodation</th>
                    @foreach($trip->questions as $question)
                        <th>{{ $question->label }}</th>
                    @endforeach
                    @if ($trip->event->reservations_enabled)
                        <th>Reservation notes</th>
                    @endif
                </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
                @foreach($reservations as $person)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $person->getFullName(true)}}</td>
                        <td>{{ $person->exchangeStudent->country->full_name ?? 'BUDDY'}}</td>
                        <td>{{ $person->pivot->diet ?? '-' }}</td>
                        <td>{{ $person->pivot->medical_issues }}</td>
                        <td>{{ $person->getSex() }}</td>
                        <td>{{ $person->user->email }}</td>
                        <td>{{ $person->exchangeStudent->phone ?? $person->buddy->phone ?? ''}}</td>
                        <td>{{ $person->exchangeStudent->whatsapp ?? ''}}</td>
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
    </div>
</body>
</html>