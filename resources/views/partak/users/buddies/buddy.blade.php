@extends('partak.users.layout')
@section('inner-content')
    <h2>Buddy detail</h2>
    <ul class="list-group">
        <li>{{ $buddy->person->first_name. ' ' .$buddy->person->last_name }}</li>
    </ul>

    @if(isset($myStudents))
        <span class="vspace"></span>
        <h3>Exchange students for {{ $currentSemester }}</h3>
        <table class="table">
            <tr>
                <th>Name</th>
                <th>email</th>
            </tr>
            @foreach($myStudents as $exStudent)
                <tr>
                    <td>{{ $exStudent->person->first_name. ' ' . $exStudent->person->last_name }}</td>
                    <td>{{ $exStudent->person->user->email }}</td>
                </tr>
            @endforeach
        </table>
    @endif

    @stop