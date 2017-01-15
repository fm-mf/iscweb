@extends('layouts.buddyprogram.layout')
@section('content')

    <div class="container-fluid page">
        <h1>MOJI STUDENTI</h1>
        <table>
            <thead>
            <tr>
                <th>Jméno</th>
                <th>Příjmení</th>
                <th>Národnost</th>
                <th>Fakulta</th>
                <th>Kolej</th>
                <th>Pohlaví</th>
            </tr>
            </thead>
            <tbody>
            @if($myStudents)
                @foreach($myStudents as $exchangeStudent)
                    <tr>
                        <td><a href="{{url('/mujbuddy/profile/' . $exchangeStudent->id_user)}}">{{ $exchangeStudent->person->first_name }}</a></td>
                        <td><a href="{{url('/mujbuddy/profile/' . $exchangeStudent->id_user)}}">{{ $exchangeStudent->person->last_name }}</a></td>
                        <td>{{ $exchangeStudent->country->full_name }}</td>
                        <td>{{ $exchangeStudent->faculty->faculty }}</td>
                        <td>{{ $exchangeStudent->accommodation->full_name }}</td>
                        <td>{{ $exchangeStudent->person->sex == null ? "" : ($exchangeStudent->person->sex == 'M' ? 'muž' : 'žena') }}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@stop