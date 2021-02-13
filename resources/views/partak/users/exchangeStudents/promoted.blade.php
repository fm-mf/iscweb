@extends('partak.users.layout')
@section('inner-content')
    <div class="container">
        <div class="success top-message">
            <i class="fas fa-check mr-1"></i> {{ $exStudent->user->person->fullName }} is now a buddy!
        </div>

        <div class="alert alert-info my-4">
           The account now doesn't have any password. Tell the student to open <a href="{{ route('auth.password-reset-form') }}">Password Reset Page</a> ( {{ route('auth.password-reset-form') }} ) and use his/her e-mail to set a new password.
        </div>

        <a
            href="{{ url('partak/users/buddies/' . $exStudent->id_user) }}"
            class="btn btn-sm btn-primary mx-auto"
        >
            <i class="fas fa-address-card"></i> Go to Buddy Detail
        </a>
    </div>
@stop
