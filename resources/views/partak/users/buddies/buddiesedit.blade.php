@extends('partak.users.layout')
@section('inner-content')

    <div class="row">
        <div class="row-inner">
            <img class="img-circle pull-left buddy-detail-img"  width="100" src="{{ asset($buddy->person->avatar()) }}">
            <h3>{{ $buddy->person->first_name .' '. $buddy->person->last_name}}</h3>
        </div>
    </div>
    <div class="row">
        <div class="row-inner">
            {{ Form::model($buddy, ['url' => 'user/profile', 'method' => 'patch']) }}


            {{ Form::bsText('email', 'Email', $buddy->person->user->email) }}
            {{ Form::bsText('phone', 'Phone') }}
            {{ Form::bsSelect('id_faculty', 'Faculty', $faculties, $buddy->id_faculty, ['placeholder' => 'Choose faculty...']) }}


            <div class="form-group row" style="overflow: hidden;">
                <div class="col-sm-6 left">
                    {{ Form::label('sex', 'Sex', ['class' => 'control-label']) }}
                    @if ($errors->has('sex'))
                        <p class="error-block alert-danger">{{ $errors->first('sex') }}</p>
                    @endif
                    {{ Form::select('sex', ['M' => 'Male', 'F' => 'Female'], $buddy->person->sex, ['placeholder' => 'Choose sex...', 'class' => 'form-control']) }}
                </div>
                <div class="col-sm-6 right">
                    {{ Form::label('age', 'Year of berth', ['class' => 'control-label']) }}
                    @if ($errors->has('age'))
                        <p class="error-block alert-danger">{{ $errors->first('age') }}</p>
                    @endif
                    {{ Form::number('age', $buddy->person->age, ['class' => 'form-control']) }}
                </div>
            </div>

            <!-- TODO validation of inputs -->
            {{ Form::bsTextarea('about', 'About') }}
            {{ Form::bsSubmit('Update profile') }}
            {{ Form::close() }}
        </div>
    </div>
@stop