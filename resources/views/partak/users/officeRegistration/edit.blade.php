@extends('partak.users.officeRegistration.dashboard')
@section('inner-content-2')
    @if(session('successUpdate'))
        <div class="row">
            <div class="row-inner">
                <div class="success">
                    <span class="glyphicon glyphicon-ok" style="padding-right:5px;"></span> Profile was successfully updated.
                </div>
            </div>
        </div>
    @endif


    @include('partak.users.exStudent-Buddy_ Bubles', ['buddyRemovable' => false]);

    <div class="row">
        <div class="row-inner">
            <div class="col-sm-7">
                <protectedbutton  url="{{ url('partak/users/office-registration/register/' .$exStudent->id_user) }}"
                                  protection-text="Do you really want to register {{ $exStudent->person->first_name }} {{ $exStudent->person->last_name }} to ESN?"
                                  button-style="btn-success btn-lg"><span class="glyphicon glyphicon-ok up"></span> Register to ESN</protectedbutton>
            </div>
        </div>
    </div>

    @include('partak.users.exStudentDetailTable')
@stop