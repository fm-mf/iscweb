<!DOCTYPE html>
<html>
<body>
<h3 align="center">{{ $trip->event->name }} participants</h3>
    <div class="container">
        <div class="row row-inner">
            <div class="col-sm-12">
                <div class="panel panel-default">
                        <table border="1" cellpadding="5" cellspacing="5" align="center">
                            <tr>
                                <th>Name</th>
                                <th>Nationality</th>
                                <th>Email</th>
                                <th>Sex</th>
                                <th>Phone</th>
                                <th>ESN cart number</th>
                            </tr>
                            @foreach($particip as $participant)
                                <tr>
                                    <td> {{ $participant->person->first_name .' '. $participant->person->last_name}}</td>
                                    <td>{{ $participant->country->full_name }}</td>
                                    <td>{{ $participant->person->user->email }}</td>
                                    <td>{{ $participant->person->getSex() }}</td>
                                    <td>{{ $participant->phone }}</td>
                                    <td>{{ $participant->esn_card_number }}</td>
                                </tr>
                            @endforeach
                        </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>