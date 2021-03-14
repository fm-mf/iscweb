<table>
    <thead>
        <tr>
            <th>Student</th>
            <th>Email</th>
            <th>Quarantined until</th>
        </tr>
    </thead>
    <tbody>
        @foreach($exchangeStudents as $exchangeStudent)
            <tr>
                <td>@include('partak.components.user-link', ['user' => $exchangeStudent->person])</td>
                <td>{{ $exchangeStudent->user->email }}</td>
                <td>{{ $exchangeStudent->quarantined_until->formatLocalized(__('formatting.full-date')) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>