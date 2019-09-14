@extends('layouts.buddyprogram.layout')
@section('content')

    <div class="container page">
        <h1 class="text-center">MOJI STUDENTI</h1>

        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>Jméno</th>
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
                            <td><a href="{{url('/muj-buddy/profile/' . $exchangeStudent->id_user)}}">{{ $exchangeStudent->person->first_name }} <span class="last-name">{{ $exchangeStudent->person->last_name }}</span></a></td>
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

    </div>
@stop
