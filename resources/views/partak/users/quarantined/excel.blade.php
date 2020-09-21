<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
    <div class="container">
        <table align="center">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Email</th>
                    <th>Quarantined until</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $exStudent)
                <tr>
                    <td>@include('partak.components.user-link', ['user' => $exStudent->person])</td>
                    <td>{{ $exStudent->user->email }}</td>
                    <td>{{ $exStudent->quarantined_until->formatLocalized(__('formatting.full-date')) }}</td>
                </tr>
            @endforeach
            </tbody>
		</table>
	</div>
</body>
</html>
