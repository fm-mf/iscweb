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
                  <th>Email</th>
              </tr>
          </thead>
          <tbody>
            @foreach($buddies as $buddy)
                <tr>
                    <td>{{ $buddy->person->getFullName(true)}}</td>
                    <td>{{ $buddy->user()->email }}</td>
                </tr>
            @endforeach
        </tbody>
      </table>
  </div>
</body>
</html>