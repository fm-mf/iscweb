@extends('partak.users.layout')
@section('inner-content')
    @include('partak.users.officeRegistration.search')
    <div class="container">
        @if(session('successUpdate'))
            <div class="row">
                <div class="row-inner">
                    <div class="success">
                        <span class="glyphicon glyphicon-ok" style="padding-right:5px"></span> Profile was successfully updated.
                    </div>
                </div>
            </div>
        @endif
            <div class="row">
                <div class="row-inner">
                    <div class="col-md-7">
                        {{ Form::model($exStudent, ['url' => 'partak/users/office-registration/create', 'method' => 'patch']) }}
                        {{ Form::bsText('first_name', 'First Name', 'required') }}
                        {{ Form::bsText('last_name', 'Last Name', 'required') }}

                        {{ Form::bsText('email', 'Email', 'required') }}
                        {{ Form::bsText('phone', 'Phone') }}
                        {{ Form::label('esn_registered', 'ESN registered', ['class' => 'control-label']) }}
                        {{ Form::checkbox('esn_registered', 'y' )}}
                        {{ Form::bsText('esn_card_number', 'ESN card number') }}
                        {{ Form::bsSelect('id_faculty', 'Faculty', $faculties,null, ['placeholder' => 'Choose faculty...']) }}
                        {{ Form::bsSelect('id_accommodation', 'Accommodation', $accommodations, null, ['placeholder' => 'Choose accommodation...']) }}
                        {{ Form::bsSelect('id_country', 'County', $countries, null, ['placeholder' => 'Choose country...']) }}


                        <div class="form-group row" style="overflow: hidden">
                            <div class="col-sm-6 left">
                                {{ Form::label('sex', 'Sex', ['class' => 'control-label']) }}
                                @if ($errors->has('sex'))
                                    <p class="error-block alert-danger">{{ $errors->first('sex') }}</p>
                                @endif
                                {{ Form::select('sex', ['M' => 'Male', 'F' => 'Female'], null, ['placeholder' => 'Choose sex...', 'class' => 'form-control']) }}
                            </div>
                            <div class="col-sm-6 right">
                                {{ Form::label('age', 'Year of berth', ['class' => 'control-label']) }}
                                @if ($errors->has('age'))
                                    <p class="error-block alert-danger">{{ $errors->first('age') }}</p>
                                @endif
                                {{ Form::number('age','1990', ['class' => 'form-control']) }}
                            </div>
                        </div>

                        {{ Form::bsText('medical_issues', 'Medical issues') }}
                        {{ Form::bsSelect('diet', 'Diet', $diets, null, ['placeholder' => 'No diet'])  }}
                        {{ Form::bsTextarea('about', 'About') }}

                        {{ Form::bsSubmit('Create exchange student') }}

                        {{ Form::close() }}
                    </div>
                </div>
            </div>

    </div>
@stop