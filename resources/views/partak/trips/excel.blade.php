<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>

<body>
<h3 align="center">{{ $trip->event->name }} participants</h3>
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
                    <th>ESN cart number</th>
                    <th>Accommodation</th>
                    <th>Comment to payment</th>
                    <th>Paid</th>
                    <th>Register By</th>
                    @foreach($trip->questions as $question)
                        <th>{{ $question->label }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
                @foreach($particip as $participant)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $participant->getFullName(true)}}</td>
                        <td>{{ $participant->exchangeStudent->country->full_name ?? 'BUDDY'}}</td>
                        <td>{{ $participant->diet ?? '-' }}</td>
                        <td>{{ $participant->medical_issues }}</td>
                        <td>{{ $participant->getSex() }}</td>
                        <td>{{ $participant->user->email }}</td>
                        <td>{{ $participant->exchangeStudent->phone ?? $participant->buddy->phone ?? ''}}</td>
                        <td>{{ $participant->exchangeStudent->whatsapp ?? ''}}</td>
                        <td>{{ $participant->exchangeStudent->esn_card_number ?? '' }}</td>
                        <td>{{ $participant->exchangeStudent->accommodation->full_name ?? ''}}</td>
                        <td>{{ $participant->pivot->comment }}</td>
                        <td>{{ $participant->pivot->paid }}</td>
                        <td>{{ \App\Models\Person::find($participant->pivot->registered_by)->getFullName() }}</td>
                        @foreach(
                            \App\Models\EventReservation::findByUserAndEvent($participant->id_user, $trip->id_event)
                                ->withTrashed()
                                ->first()
                                ->answers as $data
                        )
                            <td>{{ $data->getDisplayValue() }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>