@extends('partak.users.layout')
@section('inner-content')

    <div class="container">
        @if(session('successUpdate'))
            <div class="row">
                <div class="row-inner">
                    <div class="success">
                        <span class="glyphicon glyphicon-ok" style="padding-right:5px;"></span> Profile was successfully updated.
                    </div>
                </div>
            </div>
        @endif


        <div class="row">
            <div class="row-inner">
                <img class="img-circle pull-left buddy-detail-img"  width="125" src="{{ asset($exStudent->person->avatar()) }}">
                <h3>{{ $exStudent->person->first_name .' '. $exStudent->person->last_name}}</h3>

            </div>
        </div>
        <div class="row">
            <div class="row-inner">
                <div class="col-md-7">
                    {{ Form::model($exStudent, ['url' => 'partak/users/exchange-students/edit/'. $exStudent->id_user, 'method' => 'patch']) }}
                        {{ Form::bsText('email', 'Email','required', $exStudent->person->user->email) }}
                        {{ Form::bsText('phone', 'Phone') }}
                        {{ Form::label('esn_registered', 'ESN registered', ['class' => 'control-label']) }}
                        {{ Form::checkbox('esn_registered', 'y', $exStudent->esn_registered == 'y') }}
                        {{ Form::bsText('esn_card_number', 'ESN card number') }}
                        {{ Form::bsSelect('id_faculty', 'Faculty', $faculties, $exStudent->id_faculty, ['placeholder' => 'Choose faculty...', 'required' =>'required']) }}
                        {{ Form::bsSelect('id_accommodation', 'Accommodation', $accommodations, $exStudent->id_accommodation, ['placeholder' => 'Choose accommodation...', 'required' =>'required']) }}
                        {{ Form::bsSelect('id_country', 'Country', $countries, $exStudent->id_country, ['placeholder' => 'Choose country...', 'required' =>'required']) }}

                        {{ Form::label('fullTime', 'Full-time student', ['class' => 'control-label']) }}
                        {{ Form::checkbox('fullTime', 'y') }}

                        <div class="form-group row" style="overflow: hidden;">
                            <div class="col-sm-6 left">
                                {{ Form::label('sex', 'Sex', ['class' => 'control-label required']) }}
                                @if ($errors->has('sex'))
                                    <p class="error-block alert-danger">{{ $errors->first('sex') }}</p>
                                @endif
                                {{ Form::select('sex', ['M' => 'Male', 'F' => 'Female'], $exStudent->person->sex, ['placeholder' => 'Choose sex...', 'class' => 'form-control', 'required' =>'required']) }}
                            </div>
                            <div class="col-sm-6 right">
                                {{ Form::label('age', 'Year of birth', ['class' => 'control-label']) }}
                                @if ($errors->has('age'))
                                    <p class="error-block alert-danger">{{ $errors->first('age') }}</p>
                                @endif
                                {{ Form::number('age', $exStudent->person->age, ['class' => 'form-control']) }}
                            </div>
                        </div>

                        <!-- {{ Form::bsText('medical_issues', 'Medical issues','', $exStudent->person->medical_issues) }} -->

                        {{ Form::bsSelect('diet', 'Food preference', $diets, $exStudent->person->diet, ['placeholder' => 'No preference'])  }}
                        {{ Form::bsTextarea('about', 'About') }}
                        {{ Form::bsSubmit('Update profile') }}

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@stop
