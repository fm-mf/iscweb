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
            @if(session('resetLinkSentSuccessful'))
                <div class="row">
                    <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
                        <p class="alert alert-success">
                            @lang('tandem.passwords.reset-link-sent', ['email' => session('email')])
                        </p>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
                    <form action="{{ route('tandem.password.email') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="required" for="input-email">@lang('tandem.auth.e-mail')</label>
                            <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" id="input-email" required="required" placeholder="@lang('tandem.auth.placeholder.e-mail')" />
                            @if($errors->has('email'))
                                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">@lang('tandem.passwords.send-link')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
