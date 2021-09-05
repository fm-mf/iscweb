@extends('auth.layouts.layout')

@section('title', __('auth.verification.title'))

@section('page')
    <h1>@lang('auth.verification.title')</h1>
    @lang('auth.verification.invalid-hash')
@endsection
