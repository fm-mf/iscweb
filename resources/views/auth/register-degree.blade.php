@extends('auth.layouts.layout')

@section('title', __('auth.registration'))

@section('page')
    <h1>
        @lang('auth.registration-heading') – @lang('auth.register-check.degree')
    </h1>
    <p>
        To apply for a Buddy, please, contact our
        <a href="mailto:buddy@isc.cvut.cz">
            Buddy coordinator (buddy@isc.cvut.cz)
        </a>.
    </p>
@endsection
