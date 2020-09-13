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
                        <div class="row flex-wrap-reverse">
                            <div class="col text-md-left">
                                <div class="form-group">
                                    <a href="{{ route('tandem.main') }}" class="btn btn-outline-secondary d-block d-md-inline-block">
                                        <span class="fas fa-arrow-left"></span>
                                        @lang('tandem.profile.back')
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <a href="{{ route('tandem.password.change') }}" class="btn btn-outline-primary d-block d-md-inline-block">
                                        <span class="fas fa-key"></span>
                                        @lang('tandem.passwords.change-password')
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary d-block d-md-inline w-100">
                                        <span class="fas fa-save"></span>
                                        @lang('tandem.profile.update')
                                    </button>
                                </div>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <form action="{{ route('tandem.my-profile') }}" method="POST" id="delete-account-form" class="mt-5">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <protected-submit-button
                            protection-title="@lang('tandem.my-profile.delete-modal-title')"
                            protection-text=""
                            proceed-text="@lang('tandem.my-profile.delete')"
                            classes="btn-outline-danger"
                            proceed-classes="btn-danger"
                            modal-body-classes=""
                            :custom-modal-body="true"
                        >
                            <template v-slot:modal-body>
                                <p>@lang('tandem.my-profile.delete-modal-text-1')</p>
                                <p>@lang('tandem.my-profile.delete-modal-text-2')</p>
                            </template>
                            @lang('tandem.my-profile.delete-account')
                        </protected-submit-button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
