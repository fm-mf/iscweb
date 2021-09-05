@extends('auth.layouts.layout')

@section('title', __('auth.verification.title'))

@section('page')
    <h1>@lang('auth.thanks.heading')</h1>

    @if ($verified)
        @lang('auth.thanks.verified', ['href' => route('buddy-home')])
    @else
        @lang('auth.thanks.not-verified', ['href' => route(__('routes.web.calendar'))])
    @endif
    @lang('auth.thanks.survey-request')

    @include('auth.verification._typeform')
@endsection
