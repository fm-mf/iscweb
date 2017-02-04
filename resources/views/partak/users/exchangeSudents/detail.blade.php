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
    <h2>Exchange student</h2>
        <div class="row">
        <div class="row-inner buddy-detail">
            <div class="col-sm-6">
                <h3>Detail</h3>
                <img class="img-circle pull-left buddy-detail-img"  width="100" src="{{ asset($exStudent->person->avatar()) }}">
                <h3>{{ $exStudent->person->first_name .' '. $exStudent->person->last_name}}</h3>
                <a href="{{ url('partak/users/exchange-students/edit/' . $exStudent->id_user) }}" class="btn btn-xs btn-success edit-button"><span class="glyphicon glyphicon-pencil up"></span> Edit</a> <br>
                <span class="glyphicon glyphicon-envelope up buddy-detail-icon"></span> {{ $exStudent->person->user->email }} <br>
                <span class="glyphicon glyphicon-phone-alt buddy-detail-icon"></span> @if(isset($exStudent->phone)) {{ $exStudent->phone }} @else No Phone @endif<br>
                @if($exStudent->esn_registered === 'y') <span class="glyphicon glyphicon-ok buddy-detail-icon"  style="color: #449D44"></span> ESN Registered
                @else <span class="glyphicon glyphicon-remove buddy-detail-icon" style="color: #C9302C"></span> Not ESN Registered
                @endif
            </div>
            <div class="col-sm-6">
                <h3 >Buddy detail</h3>
                @if(isset($exStudent->buddy))
                    <img class="img-circle pull-left buddy-detail-img"  width="100" src="{{ asset($exStudent->buddy->person->avatar()) }}">
                    <h3>{{ $exStudent->buddy->person->first_name .' '. $exStudent->buddy->person->last_name}}</h3>
                    <a href="{{ url('partak/users/buddies/'. $exStudent->buddy->id_user .'/remove/' .$exStudent->id_user) }}" role="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove up"></span> Remove</a><br>
                    <span class="glyphicon glyphicon-envelope up buddy-detail-icon"></span> {{ $exStudent->buddy->person->user->email }} <br>
                    <span class="glyphicon glyphicon-phone-alt buddy-detail-icon"></span> @if(isset($exStudent->buddy->phone)) {{ $exStudent->buddy->phone }} @else No Phone @endif<br>
                    @if($exStudent->buddy->verified == 'y') <span class="glyphicon glyphicon-ok buddy-detail-icon"></span> Verified
                    @elseif ($exStudent->buddy->verified == 'n') <span class="glyphicon glyphicon-time buddy-detail-icon"></span> Not verified yet
                    @else <span class="glyphicon glyphicon-remove buddy-detail-icon"></span> Denied
                    @endif
                @else
                    <h3>Don't have Buddy!!</h3>
                @endif
            </div>

        </div>
    </div>
    <div class="row">
        <div class="row-inner">
            <div class="col-sm-8">
                <label for="unique_url">Unique URL</label>
                <div class="input-group">
                    <span class="input-group-addon" id="url"><span class="glyphicon glyphicon-link"></span> </span>
                    <input type="text" id="unique_url" class="form-control" value="{{ url('/exchange/'). '/' . $exStudent->person->user->hash }}" aria-describedby="url" readonly="">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-duplicate""></span> </button>
                      </span>
                </div><!-- /input-group -->
            </div>
        </div>
    </div>

    <div class="row row-grey">
        <div class="row-inner">
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <table class="table">
                        <tr>
                            <th>Country</th>
                            <td>{{ $exStudent->country->full_name }}</td>
                        </tr>
                        <tr>
                            <th>Faculty</th>
                            <td>{{ $exStudent->faculty->faculty }}</td>
                        </tr>
                        <tr>
                            <th>School</th>
                            <td>{{ $exStudent->school }}</td>
                        </tr>
                        <tr>
                            <th>Accommodation</th>
                            <td>{{ $exStudent->accommodation->full_name_eng }}</td>
                        </tr>
                        @if(! isset($exStudent->buddy))
                            <tr>
                                <th>Want Buddy</th>
                                <td>{{ ($exStudent->want_buddy === 'y')? "Yes" : "No" }}</td>
                            </tr>
                        @endif
                        <tr>
                            <th>ESN registered</th>
                            <td>{{ ($exStudent->esn_registered === 'y')? "Yes" : "No" }}</td>
                        </tr>
                        @if(isset($exStudent->esn_card_number))
                            <tr>
                                <th>ESN card number</th>
                                <td>{{ $exStudent->esn_card_number }}</td>
                            </tr>
                        @endif

                    </table>
                </div>
            </div>
        </div>
    </div>
@stop