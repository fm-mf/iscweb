<!DOCTYPE html>
<html>

<link href="{{ asset('css/pdf.css') }}" rel="stylesheet" type="text/css">

<style>
</style>

<body>
<h3 align="center">{{ $trip->event->name }} participants</h3>

<div class="container">

                        <table class="table table-striped" align="center">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Nationality</th>
                                    <th>Email</th>
                                    <th>Sex</th>
                                    <th>Phone</th>
                                    <th>ESN cart number</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($particip as $participant)
                                <tr>
                                    <td> {{ $participant->person->last_name .' '. $participant->person->first_name}}</td>
                                    <td>{{ $participant->country->full_name }}</td>
                                    <td>{{ $participant->person->user->email }}</td>
                                    <td>{{ $participant->person->getSex() }}</td>
                                    <td>{{ $participant->phone }}</td>
                                    <td>{{ $participant->esn_card_number }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
</div>
</body>
</html>