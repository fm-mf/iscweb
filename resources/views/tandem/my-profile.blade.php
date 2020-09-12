@extends('tandem.layouts.layout')

@section('title', __('tandem.my-profile.title') . ' – ' . __('tandem.page-title'))

@section('page')
    <section>
        <div class="container">
            @if(session('updateSuccessful'))
                <div class="row">
                    <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
                        <p class="alert alert-success">
                            @lang('tandem.my-profile.update-successful')
                        </p>
                    </div>
                </div>
            @endif
            @if(session('passwordChangeSuccessful'))
                <div class="row">
                    <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
                        <p class="alert alert-success">
                            @lang('tandem.passwords.password-change-successful')
                        </p>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-10 col-xl-8 mx-auto">
                    {{ Form::model($tandemUser, [
                        'method' => 'patch',
                        'route' => 'tandem.my-profile',
                        'id' => 'vue-form',
                    ]) }}
                        <div class="form-group">
                            {{ Form::label('email', __('tandem.auth.e-mail'), ['class' => 'required']) }}
                            {{ Form::email('email', $tandemUser->email, ['class' => 'form-control', 'disabled' => 'disabled', 'required' => 'required']) }}
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    {{ Form::label('first_name', __('tandem.profile.given-names'), ['class' => 'required']) }}
                                    {{ Form::text('first_name', $tandemUser->first_name, ['class' => 'form-control', 'disabled' => 'disabled', 'required' => 'required']) }}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('last_name', __('tandem.profile.surname')) }}
                                    {{ Form::text('last_name', $tandemUser->last_name, ['class' => 'form-control', 'placeholder' => __('tandem.profile.placeholder.surname')]) }}
                                </div>
                            </div>
                        </div>
                        @include('tandem.partials.my-profile')
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <span class="fas fa-save"></span>
                                @lang('tandem.profile.update')
                            </button>
                        </div>
                    {{ Form::close() }}
                    <div class="form-group">
                        <a href="{{ route('tandem.password.change') }}" class="btn btn-outline-primary">
                            <span class="fas fa-key"></span>
                            @lang('tandem.passwords.change-password')
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
