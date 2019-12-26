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
                    <th>#</th>
                    <th>Name</th>
                    <th>Nationality</th>
                    <th class="star">Diet</th>
                    <th>Medical issues</th>
                    <th>Sex</th>
                    <th>Phone</th>
                    <th>WhatsApp</th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
                @foreach($particip as $participant)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $participant->getFullName(true)}}</td>
                        <td>{{ $participant->exchangeStudent->country->full_name ?? 'BUDDY' }}</td>
                        <td>{{ $participant->diet ? $participant->getShortDiet()  : '-' }}</td>
                        <td>{{ $participant->medical_issues }}</td>
                        <td>{{ $participant->getSex() }}</td>
                        <td>{{ $participant->exchangeStudent->phone ?? $participant->buddy->phone ?? '' }}</td>
                        <td>{{ $participant->exchangeStudent->whatsapp ?? '' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>