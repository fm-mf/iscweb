@extends('partak.users.layout')
@section('inner-content')
    <div class="container">
        @include("partak.components.student-search", [
            'target' => '/partak/users/office-registration/registration/{id_user}'
        ])
    </div>

    <div class="container">
        @if(session('successRegister'))
            <div class="success top-message">
                <i class="fas fa-check mr-1"></i> {{ $exStudent->person->first_name }} was successfully registered
            </div>
        @endif
    </div>

    @include('partak.users.partials.exstudent-with-buddy', ['buddyRemovable' => false])

    <div class="container mt-2">
        <div class="row justify-content-sm-center">
            <div class="col-sm-9 col-md-6 col-xl-5 text-center">
                @if($exStudent->is_not_esn_registered)
                    @can('acl', 'exchangeStudents.register')
                        {{ Form::model($exStudent, ['method' => 'post', 'route' => ['partak.users.registration.register', $exStudent], 'id' => 'form-register']) }}
                        @if($exStudent->phone === null)
                            <div class="form-group">
                                {{ Form::label('phone', 'Phone', ['class' => 'required'])  }}
                                {{ Form::text('phone', $exStudent->phone, ['class' => 'form-control' . ($errors->has('phone') ? ' is-invalid' : ''), 'required' => 'required']) }}
                                @if ($errors->has('phone'))
                                    <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
                                @endif
                                <small class="form-text text-muted">Scan the phone number using the barcode scanner – keyboard layout must be set to English</small>
                            </div>
                        @endif
                        @if($exStudent->esn_card_number === null)
                            <div class="form-group">
                                {{ Form::label('esn_card_number', 'ESNcard number', ['class' => 'required'])  }}
                                {{ Form::text('esn_card_number', $exStudent->esn_card_number, ['class' => 'form-control' . ($errors->has('esn_card_number') ? ' is-invalid' : ''), 'required' => 'required']) }}
                                @if ($errors->has('esn_card_number'))
                                    <div class="invalid-feedback">{{ $errors->first('esn_card_number') }}</div>
                                @endif
                                <small class="form-text text-muted">Scan the ESNcard number using the barcode scanner – keyboard layout must be set to English</small>
                            </div>
                        @endif
                        <protected-submit-button
                            protection-title="Register to ESN?"
                            protection-text="Do you really want to register {{ $exStudent->person->first_name }} to ESN?"
                            proceed-text="Register"
                            cancel-text="Cancel"
                            classes="btn-warning btn-lg"
                        >
                            <span class="fas fa-user-check"></span> Register to ESN
                        </protected-submit-button>
                        {{ Form::close() }}
                    @endcan
                @else
                    <button class="btn btn-success btn-lg">
                        <span class="fas fa-user-check"></span> Registered
                    </button>
                @endif
            </div>
        </div>
    </div>

    @include('partak.users.partials.exstudent-detail-table')
@stop
