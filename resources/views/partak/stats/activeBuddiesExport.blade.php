<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>E-mail</th>
        </tr>
    </thead>
    <tbody>
        @foreach($buddies as $buddy)
            <tr>
                <td>{{ $buddy->person->getFullName(true)}}</td>
                <td>{{ $buddy->user->email }}</td>
            </tr>
        @endforeach
    </tbody>
</table>