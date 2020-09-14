@extends('tandem.layouts.layout')

@section('title', __('tandem.auth.registration') . ' – ' . __('tandem.page-title'))

@section('page')
    <section>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1>@lang('tandem.auth.registration-heading')</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
                    <form action="{{ route('tandem.register') }}" method="POST" id="vue-form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="required" for="input-email">@lang('tandem.auth.e-mail')</label>
                            <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" id="input-email" value="{{ old('email') }}" required="required" placeholder="@lang('tandem.auth.placeholder.e-mail')" />
                            @if($errors->has('email'))
                                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="required" for="input-password">@lang('tandem.auth.password')</label>
                            <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" id="input-password" required="required" placeholder="@lang('tandem.auth.placeholder.password')" minlength="8" />
                            @if($errors->has('password'))
                                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                            @endif
                            <small class="form-text text-muted">@lang('tandem.auth.password-note')</small>
                        </div>
                        <div class="form-group">
                            <label class="required" for="input-password-confirmation">@lang('tandem.auth.password-confirmation')</label>
                            <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password_confirmation" id="input-password-confirmation" required="required" placeholder="@lang('tandem.auth.placeholder.password-confirmation')" minlength="8" />
                            @if($errors->has('password'))
                                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="required" for="input-first-name">@lang('tandem.profile.given-names')</label>
                            <input type="text" class="form-control {{ $errors->has('firstName') ? 'is-invalid' : '' }}" name="firstName" id="input-first-name" value="{{ old('firstName') }}" required="required" placeholder="@lang('tandem.profile.placeholder.given-names')" />
                            @if($errors->has('firstName'))
                                <div class="invalid-feedback">{{ $errors->first('firstName') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="input-last-name">@lang('tandem.profile.surname')</label>
                            <input type="text" class="form-control {{ $errors->has('lastName') ? 'is-invalid' : '' }}" name="lastName" id="input-last-name" value="{{ old('lastName') }}" placeholder="@lang('tandem.profile.placeholder.surname')" />
                            @if($errors->has('lastName'))
                                <div class="invalid-feedback">{{ $errors->first('lastName') }}</div>
                            @endif
                        </div>
                        @include('tandem.partials.my-profile')
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">@lang('tandem.auth.register')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
