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
                    <th>ESN cart number</th>
                    <th>Accommodation</th>
                    <th>Comment to payment</th>
                    <th>Paid</th>
                    <th>Register By</th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
                @foreach($particip as $participant)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $participant->person->last_name .' '. $participant->person->first_name}}</td>
                        <td>{{ $participant->whoAmI('exchangeStudent')?  $participant->country->full_name : 'BUDDY'}}</td>
                        <td>{{ $participant->person->diet ? $participant->person->diet  : '-' }}</td>
                        <td>{{ $participant->person->medical_issues }}</td>
                        <td>{{ $participant->person->getSex() }}</td>
                        <td>{{ $participant->person->email }}</td>
                        <td>{{ $participant->phone }}</td>
                        <td>@if($participant->whoAmI('exchangeStudent')) {{ $participant->esn_card_number }}@endif</td>
                        <td>@if($participant->whoAmI('exchangeStudent')){{ $participant->accommodation->full_name }}@endif</td>
                        <td>{{ $participant->pivot->comment }}</td>
                        <td>{{ $participant->pivot->paid }}</td>
                        <td>{{ \App\Models\Person::find($participant->pivot->registered_by)->getFullName() }}</td>
                    </tr>
                    <?php $i++; ?>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>