@extends('partak.users.layout')
@section('inner-content')

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
        <div class="row-inner buddy-detail">
            <img class="img-circle pull-left buddy-detail-img"  width="100" src="{{ asset($buddy->person->avatar()) }}">
            <h3>{{ $buddy->person->first_name .' '. $buddy->person->last_name}}</h3>
            @if($buddy->verified == 'y') <span class="glyphicon glyphicon-ok buddy-detail-icon"></span> Verified
            @elseif ($buddy->verified == 'n') <span class="glyphicon glyphicon-time buddy-detail-icon"></span> Not verified yet
            @else <span class="glyphicon glyphicon-remove buddy-detail-icon"></span> Denied
            @endif
        </div>
    </div>
    <div class="row">
        <div class="row-inner">
            <div class="col-md-7">
                {{ Form::model($buddy, ['url' => 'partak/users/buddies/edit/'. $buddy->id_user, 'method' => 'patch', 'id' => 'form']) }}
                    {{ Form::bsText('email', 'Email', $buddy->person->user->email) }}
                    {{ Form::bsText('phone', 'Phone') }}

                        <multiselectinput formName="roles" title="Roles" :options="options.roles" :value="options.sroles" :show-labels="false" label="title" track-by="id_role" placeholder="Roles"
                                     :multiple="true"></multiselectinput>

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
    </div>
@stop

@section('scripts')
    @parent
    <script src="https://cdn.jsdelivr.net/vue.multiselect/2.0/vue-multiselect.min.js"></script>
    <script src="{{ asset('js/multiselect.js') }}"></script>

@stop