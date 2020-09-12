@extends('tandem.layouts.layout')

@section('title', __('tandem.passwords.password-change') . ' – ' . __('tandem.page-title'))

@section('page')
    <section>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1>@lang('tandem.passwords.password-change')</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
                    <form action="{{ route('tandem.password.change') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="required" for="input-current-password">@lang('tandem.passwords.current-password')</label>
                            <input type="password" class="form-control{{ $errors->has('current_password') ? ' is-invalid' : '' }}" name="current_password" id="input-current-password" required="required" placeholder="@lang('tandem.passwords.placeholder.current-password')" />
                            @if($errors->has('current_password'))
                                <div class="invalid-feedback">{{ $errors->first('current_password') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="required" for="input-password">@lang('tandem.passwords.new-password')</label>
                            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="input-password" required="required" placeholder="@lang('tandem.passwords.placeholder.new-password')" />
                            @if($errors->has('password'))
                                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                            @endif
                            <small class="form-text text-muted">@lang('tandem.auth.password-note')</small>
                        </div>
                        <div class="form-group">
                            <label class="required" for="input-password-confirmation">@lang('tandem.passwords.new-password-confirmation')</label>
                            <input type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" id="input-password-confirmation" required="required" placeholder="@lang('tandem.passwords.placeholder.new-password-confirmation')" />
                            @if($errors->has('password_confirmation'))
                                <div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <span class="fas fa-key"></span>
                                @lang('tandem.passwords.change-password')
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
