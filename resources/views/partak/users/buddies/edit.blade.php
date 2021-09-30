@extends('partak.users.layout')
@section('inner-content')

    @if(session('successUpdate'))
        <div class="container">
            <div class="alert alert-success">
                <i class="fas fa-check mr-1"></i> Profile was successfully updated.
            </div>
        </div>
    @endif

    <div class="container">
        <div class="row container">
            <div class="col-sm-2">
                <img class="img-circle pull-left buddy-detail-img"  width="100" src="{{ asset($buddy->person->avatar()) }}">
            </div>
            <div class="col-sm-10">
                <div class="d-flex align-items-start">
                    <h3>{{ $buddy->person->first_name .' '. $buddy->person->last_name}}</h3>
                    <a href="{{ $buddy->getDetailLink() }}" class="btn btn-primary btn-sm ml-3">
                        <i class="fas fa-address-card"></i> Detail
                    </a>
                </div>

                <div class="info-line">
                    @if($buddy->verified == 'y')
                        <i class="fas fa-check fa-fw mr-1"></i> Verified
                    @elseif ($buddy->verified == 'n')
                        <i class="fas fa-hourglass-half fa-fw mr-1"></i> Not verified yet
                    @else
                        <i class="fas fa-times fa-fw mr-1"></i> Denied
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row row-inner">
            <div class="col-md-7">
                {{ Form::model($buddy, ['route' => ['partak.users.buddies.update', ['buddy' => $buddy]], 'method' => 'patch', 'id' => 'roles']) }}
                    {{ Form::bsText('email', 'Email','required', $buddy->person->user->email) }}
                    {{ Form::bsText('phone', 'Phone') }}
                    {{ Form::bsSelect('id_country', 'Country', $countries, $buddy->id_country, ['placeholder' => 'Choose country...']) }}
                    @can('acl', 'roles.view')
                        <multiselectinput formName="roles" title="Roles" :options="options.roles" :value="options.sroles" :show-labels="false" label="title" track-by="id_role" placeholder="Roles"
                                     :multiple="true"></multiselectinput>
                        @if ($errors->has('roles'))
                            <p class="error-block alert-danger">{{ $errors->first('roles') }}</p>
                        @endif
                    @endcan
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
                            {{ Form::label('age', 'Year of birth', ['class' => 'control-label']) }}
                            @if ($errors->has('age'))
                                <p class="error-block alert-danger">{{ $errors->first('age') }}</p>
                            @endif
                            {{ Form::number('age', $buddy->person->age, ['class' => 'form-control']) }}
                        </div>
                    </div>

                    <!-- {{ Form::bsText('medical_issues', 'Medical Issues','', $buddy->person->medical_issues) }} -->

                    {{ Form::bsSelect('diet', 'Food preference', $diets, $buddy->person->diet, ['placeholder' => 'No preference'])  }}

                    {{ Form::bsTextarea('about', 'About') }}

                    {{ Form::bsSubmit('Update profile') }}



                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
