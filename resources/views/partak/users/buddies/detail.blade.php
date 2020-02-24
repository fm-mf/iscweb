@extends('partak.users.layout')
@section('inner-content')
    @if (session('removeSuccess'))
        <div class="row">
            <div class="row-inner">
                <div class="success">
                    <i class="fas fa-check mr-1"></i> {{ session('removeSuccess') }}
                </div>
            </div>
        </div>
    @endif

    <div class="container">
        <div class="row-inner buddy-detail">
            <h2 >Buddy detail</h2>
            <img class="img-circle pull-left buddy-detail-img"  width="125" src="{{ asset($buddy->person->avatar()) }}">
            <h3>{{ $buddy->person->first_name .' '. $buddy->person->last_name}}</h3>
            @can('acl', 'buddy.edit')<a href="{{ url('partak/users/buddies/edit/' . $buddy->id_user) }}" class="btn btn-xs btn-success edit-button"><span class="glyphicon glyphicon-pencil up"></span> Edit</a> <br>@endcan
            <span class="glyphicon glyphicon-envelope up buddy-detail-icon"></span> {{ $buddy->person->user->email }} <br>
            <span class="glyphicon glyphicon-phone-alt buddy-detail-icon"></span> @if(isset($buddy->phone)) {{ $buddy->phone }} @else No Phone @endif<br>
            @if($buddy->country)<span class="glyphicon glyphicon-globe buddy-detail-icon"></span>{{ $buddy->country->full_name }}<br>@endif
            @if($buddy->verified == 'y') <span class="glyphicon glyphicon-ok buddy-detail-icon"></span> Verified
            @elseif ($buddy->verified == 'n') <span class="glyphicon glyphicon-time buddy-detail-icon"></span> Not verified yet
            @else <span class="glyphicon glyphicon-remove buddy-detail-icon"></span> Denied
            @endif
        </div>
    </div>

    @if(isset($myStudents))
        <div class="row-grey">
            <div class="container">
                <div class="row row-inner">
                    <h3>{{ $buddy->person->first_name }}'s exchange students for {{ $currentSemester }}</h3>
                    <div class="panel panel-default">
                        <table class="table">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th></th>
                            </tr>
                            @foreach($myStudents as $exStudent)
                                <tr>
                                    <td>{{ $exStudent->person->first_name. ' ' .$exStudent->person->last_name }}</td>
                                    <td>{{ $exStudent->person->user->email }}</td>
                                    <td align="right">
                                        <a href="{{ url('partak/users/buddies/'. $buddy->id_user .'/remove/' .$exStudent->id_user) }}" role="button" class="btn btn-danger btn-xs">Remove</a>
                                        <a href="{{ url('partak/users/exchange-students/' . $exStudent->id_user) }}" role="button" class="btn btn-info btn-xs">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
@stop