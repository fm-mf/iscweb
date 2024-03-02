@extends('auth.layouts.layout')

@section('title', __('auth.registration'))

@section('page')
    <h1>
        @lang('auth.registration-heading') – @lang('auth.register-check.exchange')
    </h1>
    <p>
        As an exchange student
        <strong>you do not have to register to the Buddy programme.</strong>
        We will contact you about two months before start of your exchange
        with instructions how to apply for a Buddy.
    </p>
    <p>
        If you are an exchange student, your exchange starts in less than two months,
        and you still have not received any e-mails from us, then contact us at
        <a href="mailto:buddy@esn.cvut.cz?cc=isc@esn.cvut.cz">buddy@esn.cvut.cz</a>
        (please, add <em class="user-select-all">isc@esn.cvut.cz</em> to the copy).
    </p>
@endsection
