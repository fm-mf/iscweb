<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="{{ asset('css/pdf.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
<div class="footer">
    <span class="star"></span>
    V-Vegetarian          Vn-Vegan          F - Fish only
</div>
<h3 align="center">{{ $trip->event->name }} participants</h3>
    <div class="container">
        <table class="table table-striped" align="center">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Nationality</th>
                    <th class="star">Diet</th>
                    <th>Medical issues</th>
                    <th>Sex</th>
                    <th>Phone</th>
                </tr>
            </thead>
            <tbody>
                @foreach($particip as $participant)
                    <tr>
                        <td>{{ $participant->person->last_name .' '. $participant->person->first_name}}</td>
                        <td>{{ $participant->whoAmI('exchangeStudent')?  $participant->country->full_name : 'BUDDY' }}</td>
                        <td>{{ $participant->person->diet ? $participant->person->getShortDiet()  : '-' }}</td>
                        <td>{{ $participant->person->medical_issues }}</td>
                        <td>{{ $participant->person->getSex() }}</td>
                        <td>{{ $participant->phone }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>