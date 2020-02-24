@extends('partak.users.layout')
@section('inner-content')
    @include('partak.users.officeRegistration.search')
    <div class="container">
        @if(session('successUpdate'))
            <div class="row">
                <div class="row-inner">
                    <div class="success">
                        <i class="fas fa-check mr-1"></i> Profile was successfully updated.
                    </div>
                </div>
            </div>
        @endif


        @include('partak.users.exStudent-Buddy_Bubles', ['buddyRemovable' => false])
    </div>

    <div class="row row-inner">
        <div class="col-sm-3"></div>
        <div class="col-sm-6 align-center">

            @if($exStudent->esn_registered == 'n')
                @can('acl', 'exchangeStudents.register')
                    @if($exStudent->esn_card_number != null && $exStudent->phone != null)
                    <protectedbutton  url="{{ url('partak/users/office-registration/register/' .$exStudent->id_user) }}"
                            protection-text="Do you really want to register {{ $exStudent->person->first_name }} {{ $exStudent->person->last_name }} to ESN?"
                            button-style="btn-warning btn-lg"><span class="glyphicon glyphicon-ok up"></span> Register to ESN</protectedbutton>

                    @else
                    {{ Form::bsText('phone', 'Phone', 'required', $exStudent->phone) }}
                    {{ Form::bsText('esn_card_number', 'ESN card number', 'required', $exStudent->esn_card_number) }}
                    <protectedbutton  url="{{ url('partak/users/office-registration/register/' .$exStudent->id_user) }}"
                            protection-text="Do you really want to register {{ $exStudent->person->first_name }} {{ $exStudent->person->last_name }} to ESN?"
                            button-style="btn-warning btn-lg"
                            ids="phone esn_card_number"><span class="glyphicon glyphicon-ok up"></span> Register to ESN</protectedbutton>
                    @endif
                @endcan
            @else
                <button class="btn btn-success btn-lg"><span class="glyphicon glyphicon-ok up"></span> Registered</button>
            @endif
        </div>
        <div class="col-sm-3"></div>
    </div>
    @include('partak.users.exStudentDetailTable')
@stop
