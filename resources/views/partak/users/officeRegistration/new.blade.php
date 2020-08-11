@extends('partak.users.layout')
@section('inner-content')
    <div class="container">
        @include("partak.components.student-search", [
            'target' => '/partak/users/office-registration/registration/{id_user}'
        ])
    </div>
    
    @if(session('successUpdate'))
        <div class="success top-message">
            <i class="fas fa-check mr-1"></i> Profile was successfully updated.
        </div>
    @endif

    <div class="container">
        <div class="col-xl-8">
            {{ Form::model($exStudent, ['url' => 'partak/users/office-registration/create', 'method' => 'patch']) }}
            
            <div class="row">
                <div class="col-md-6">
                    {{ Form::bsText('first_name', 'First Name', 'required') }}
                </div>
                <div class="col-md-6">
                    {{ Form::bsText('last_name', 'Last Name', 'required') }}
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    {{ Form::bsText('email', 'Email', 'required') }}
                </div>
                <div class="col-md-6">
                {{ Form::bsText('phone', 'Phone') }}
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    {{ Form::bsTel('whatsapp', 'WhatsApp', '', null, [], 'Full number including the country prefix') }}
                </div>
                <div class="col-md-6">
                    {{ Form::bsUrl('facebook', 'Facebook', '', null, [], 'Full link to the Facebook profile') }}
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-md-6 px-4">
                    {{ Form::checkbox('esn_registered', 'y', null, ['id' => 'esn_registered'])}}
                    {{ Form::label('esn_registered', 'ESN registered', ['class' => 'control-label', 'for' => 'esn_registered']) }}
                </div>
                <div class="col-md-6">
                    {{ Form::bsText('esn_card_number', 'ESNcard number') }}
                </div>
            </div>

            {{ Form::bsSelect('id_faculty', 'Faculty', $faculties,null, ['placeholder' => 'Choose faculty...', 'required' =>'required']) }}
            {{ Form::bsSelect('id_accommodation', 'Accommodation', $accommodations, null, ['placeholder' => 'Choose accommodation...', 'required' =>'required']) }}
            {{ Form::bsSelect('id_country', 'Country', $countries, null, ['placeholder' => 'Choose country...', 'required' =>'required']) }}

            <div class="p-3">
                {{ Form::checkbox('fullTime', 'y') }}
                {{ Form::label('fullTime', 'Full-time student', ['class' => 'control-label']) }}
            </div>

            <div class="form-group row" style="overflow: hidden">
                <div class="col-sm-6 left">
                    {{ Form::label('sex', 'Sex', ['class' => 'control-label required']) }}
                    @if ($errors->has('sex'))
                        <p class="error-block alert-danger">{{ $errors->first('sex') }}</p>
                    @endif
                    {{ Form::select('sex', ['M' => 'Male', 'F' => 'Female'], null, ['placeholder' => 'Choose sex...', 'class' => 'form-control', 'required' =>'required']) }}
                </div>
                <div class="col-sm-6 right">
                    {{ Form::label('age', 'Year of birth', ['class' => 'control-label']) }}
                    @if ($errors->has('age'))
                        <p class="error-block alert-danger">{{ $errors->first('age') }}</p>
                    @endif
                    {{ Form::number('age','1990', ['class' => 'form-control']) }}
                </div>
            </div>

            <!-- {{ Form::bsText('medical_issues', 'Medical issues') }} -->
            {{ Form::bsSelect('diet', 'Food preference', $diets, null, ['placeholder' => 'No preference'])  }}
            {{ Form::bsTextarea('about', 'About') }}

            {{ Form::bsSubmit('Create exchange student') }}

            {{ Form::close() }}
        </div>
    </div>
@stop
