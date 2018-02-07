@extends('partak.users.layout')
@section('inner-content')
    @include('partak.users.officeRegistration.search')
    <div class="container">
        @if(session('successUpdate'))
            <div class="row">
                <div class="row-inner">
                    <div class="success">
                        <span class="glyphicon glyphicon-ok" style="padding-right:5px;"></span> Profile was successfully updated.
                    </div>
                </div>
            </div>
        @endif


        @include('partak.users.exStudent-Buddy_Bubles', ['buddyRemovable' => false])
    </div>

    <div class="row row-inner">
        <div class="col-md-6 align-center">
            {{ Form::bsText('phone', 'Phone', 'true', $exStudent->phone) }}
            {{ Form::bsText('esn_card_number', 'ESN card number', 'true', $exStudent->esn_card_number) }}

            @if($exStudent->esn_registered == 'n')
                @can('acl', 'exchangeStudents.register')
                <protectedbutton  url="{{ url('partak/users/office-registration/register/' .$exStudent->id_user) }}"
                                  protection-text="Do you really want to register {{ $exStudent->person->first_name }} {{ $exStudent->person->last_name }} to ESN?"
                                  button-style="btn-warning btn-lg"
                                  ids="phone esn_card_number">
                                  <span class="glyphicon glyphicon-ok up"></span> Register to ESN</protectedbutton>

                @endcan
            @else
                <button class="btn btn-success btn-lg"><span class="glyphicon glyphicon-ok up"></span> Registered</button>
            @endif
        </div>
    </div>
    @include('partak.users.exStudentDetailTable')
@stop