@extends('partak.users.layout')
@section('inner-content')
    <div class="container">
        @if(session('successUpdate'))
            <div class="success top-message">
                <i class="fas fa-check mr-1"></i> Profile was successfully updated.
            </div>
        @endif


        <div class="row container">
            <div class="col-sm-2">
                <img class="rounded-circle float-left buddy-detail-img"  width="125" src="{{ asset($exStudent->person->avatar()) }}">
            </div>
            <div class="col-sm-10">
                <h3>{{ $exStudent->person->getFullName() }} <a href="{{ route('partak.users.exchangeStudent', [$exStudent->id_user]) }}" role="button" class="btn btn-info btn-sm">Detail</a></h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-7">
                {{ Form::model($exStudent, ['url' => 'partak/users/exchange-students/edit/'. $exStudent->id_user, 'method' => 'patch']) }}
                    {{ Form::bsText('email', 'Email','required', $exStudent->person->user->email) }}
                    {{ Form::bsText('phone', 'Phone') }}
                    {{ Form::bsTel('whatsapp', 'WhatsApp', '', null, [], 'Full number including the country prefix') }}
                    {{ Form::bsUrl('facebook', 'Facebook', '', null, [], 'Full link to the Facebook profile') }}
                    {{ Form::bsText('instagram', 'Instagram', '', null, [], 'Instagram handle without @') }}
                    {{ Form::label('esn_registered', 'ESN registered') }}
                    {{ Form::checkbox('esn_registered', 'y', $exStudent->esn_registered == 'y') }}
                    {{ Form::bsText('esn_card_number', 'ESNcard number') }}
                    {{ Form::bsSelect('id_faculty', 'Faculty', $faculties, $exStudent->id_faculty, ['placeholder' => 'Choose faculty...', 'required' =>'required']) }}
                    {{ Form::bsSelect('id_accommodation', 'Accommodation', $accommodations, $exStudent->id_accommodation, ['placeholder' => 'Choose accommodation...', 'required' =>'required']) }}
                    {{ Form::bsSelect('id_country', 'Country', $countries, $exStudent->id_country, ['placeholder' => 'Choose country...', 'required' =>'required']) }}

                    {{ Form::label('fullTime', 'Full-time student') }}
                    {{ Form::checkbox('fullTime', 'y', $exStudent->degree_student) }}

                    <div class="form-group row" style="overflow: hidden;">
                        <div class="col-sm-6 left">
                            {{ Form::label('sex', 'Sex', ['class' => 'required']) }}
                            @if ($errors->has('sex'))
                                <p class="error-block alert-danger">{{ $errors->first('sex') }}</p>
                            @endif
                            {{ Form::select('sex', ['M' => 'Male', 'F' => 'Female'], $exStudent->person->sex, ['placeholder' => 'Choose sex...', 'class' => 'form-control', 'required' =>'required']) }}
                        </div>
                        <div class="col-sm-6 right">
                            {{ Form::label('age', 'Year of birth') }}
                            @if ($errors->has('age'))
                                <p class="error-block alert-danger">{{ $errors->first('age') }}</p>
                            @endif
                            {{ Form::number('age', $exStudent->person->age, ['class' => 'form-control']) }}
                        </div>
                    </div>

                    <!-- {{ Form::bsText('medical_issues', 'Medical issues','', $exStudent->person->medical_issues) }} -->

                    {{ Form::bsSelect('diet', 'Food preference', $diets, $exStudent->person->diet, ['placeholder' => 'No preference'])  }}
                    {{ Form::bsTextarea('about', 'About') }}

                    {{ Form::bsTextarea('note', 'Internal note') }}

                    @can('acl', 'quarantined')
                        {{ Form::bsText(
                            'quarantined_until',
                            'Quarantined until',
                            '',
                            $exStudent->quarantined_until ? $exStudent->quarantined_until->format('d M Y') : '',
                            ['class' => 'form-control date']
                        ) }}
                    @endcan

                    {{ Form::bsSubmit('Update profile') }}

                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop

@section('stylesheets')
    @parent
    <link href="{{ URL::asset('/css/picker.css') }}" rel="stylesheet" type="text/css">
@stop

@section('scripts')
    @parent

    <script src="{{ URL::asset('/js/picker.js') }}" defer></script>
    <script src="{{ URL::asset('/js/picker.date.js') }}" defer></script>
    <script src="{{ URL::asset('/js/picker.time.js') }}" defer></script>
    <script src="{{ mix('/js/pickers.js') }}" defer></script>
@stop
