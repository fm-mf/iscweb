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
                  <th>Name</th>
                  <th>Nationality</th>
                  <th>Email</th>
                  <th>WhatsApp</th>
                  <th>Facebook</th>
              </tr>
          </thead>
          <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->person->getFullName(true)}}</td>
                    <td>{{ $student->country->full_name ?? 'BUDDY'}}</td>
                    <td>{{ $student->user->email }}</td>
                    <td>{{ $student->whatsapp ?? ''}}</td>
                    <td>{{ $student->facebook ?? ''}}</td>
                </tr>
            @endforeach
        </tbody>
      </table>
  </div>
</body>
</html>