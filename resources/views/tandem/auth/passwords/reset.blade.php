@extends('tandem.layouts.layout')

@section('title', __('tandem.passwords.password-reset') . ' – ' . __('tandem.page-title'))

@section('page')
    <section>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1>@lang('tandem.passwords.password-reset')</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
                    <form action="{{ route('tandem.password.request') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="token" value="{{ $token }}" />
                        <div class="form-group">
                            <label class="required" for="input-email">@lang('tandem.auth.e-mail')</label>
                            <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" value="{{ old('email', $email) }}" required="required" />
                            @if($errors->has('email'))
                                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="required" for="input-password">@lang('tandem.auth.password')</label>
                            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="input-password" required="required" />
                            @if($errors->has('password'))
                                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="required" for="input-password-confirmation">@lang('tandem.auth.password-confirmation')</label>
                            <input type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" id="input-password-confirmation" required="required" />
                            @if($errors->has('password_confirmation'))
                                <div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">@lang('tandem.passwords.reset-password')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
