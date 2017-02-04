@extends('partak.users.layout')
@section('inner-content')
    @if (session('removeSuccess'))
        <div class="row">
            <div class="row-inner">
                <div class="success">
                    <span class="glyphicon glyphicon-ok" style="padding-right:5px;"></span> {{ session('removeSuccess') }}
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="row-inner">
            <h2 >Buddy detail</h2>
            <img class="img-circle pull-left buddy-detail-img"  width="100" src="{{ asset($buddy->person->avatar()) }}">
            <h3>{{ $buddy->person->first_name .' '. $buddy->person->last_name}}</h3> <!-- TODO  edit profile-->
            <span class="glyphicon glyphicon-envelope up buddy-detail-icon"></span> {{ $buddy->person->user->email }} <br>
            <span class="glyphicon glyphicon-phone-alt buddy-detail-icon"></span> @if(isset($buddy->phone)) {{ $buddy->phone }} @else No Phone @endif
            @if($buddy->verified == 'y') <span class="glyphicon glyphicon-ok buddy-detail-icon"></span> Verifide
            @elseif ($buddy->verified == 'n') <span class="glyphicon glyphicon-time buddy-detail-icon"></span> Not verified yet
            @else <span class="glyphicon glyphicon-remove buddy-detail-icon"></span> Denied
            @endif
        </div>
    </div>

    @if(isset($myStudents))
        <div class="row row-grey">
            <div class="row-inner">
                <h3>{{ $buddy->person->first_name }}'s exchange students for {{ $currentSemester }}</h3>
                <table class="table">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Remove</th>
                    </tr>
                    @foreach($myStudents as $exStudent)
                        <tr>
                            <td>{{ $exStudent->person->first_name. ' ' . $exStudent->person->last_name }}</td>
                            <td>{{ $exStudent->person->user->email }}</td>
                            <td><a href="{{ url('partak/users/buddy/'. $buddy->id_user .'/remove/' .$exStudent->id_user) }}" role="button" class="btn btn-danger btn-xs">Remove</a></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    @endif
@stop