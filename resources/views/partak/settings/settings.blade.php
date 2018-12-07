@extends('partak.settings.layout')
@section('inner-content')

    <div class="container">
        @if(session('successUpdate'))
            <div class="row">
                <div class="row-inner">
                    <div class="success">
                        <span class="glyphicon glyphicon-ok" style="padding-right:5px;"></span> Settings was successfully updated.
                    </div>
                </div>
            </div>
        @endif


        <div class="row">
            <div class="row-inner">
                <div class="col-md-7">
                    {{ Form::model($settings, ['url' => 'partak/settings', 'method' => 'patch']) }}
                    {{ Form::bsSelect('isDatabaseOpen', 'Buddy database is', ['true' => 'Open', 'false' => 'Closed'], $settings['isDatabaseOpen'] ? 'true' : 'false')  }}
                    {{ Form::bsText('rector', 'Rector') }}

                    <div class="form-group">
                    {{ Form::label('limitPerDay', 'Buddy database limit per day', ['class' => 'control-label']) }}
                    @if ($errors->has('limitPerDay'))
                        <p class="error-block alert-danger">{{ $errors->first($name) }}</p>
                    @endif
                    {{ Form::number('limitPerDay',$settings['limitPerDay'], ['class' => 'form-control']) }}
                    </div>

                    {{ Form::bsSelect('currentSemester', 'Current Semester', $semesters, $settings['currentSemester']) }}

                    {{ Form::label('date', 'Welcome package from', ['class' => 'control-label']) }}
                    @if ($errors->has('date'))
                        <p class="error-block alert-danger">{{ $errors->first('date') }}</p>
                    @endif
                    {{ Form::text('wcFrom', $settings['wcFrom']->format('d M Y'), ['id' => 'wcFrom', 'class' => 'form-control arrival date', 'style' => 'margin-bottom: 15px']) }}

                    {{ Form::label('date', 'OW from', ['class' => 'control-label']) }}
                    @if ($errors->has('date'))
                        <p class="error-block alert-danger">{{ $errors->first('date') }}</p>
                    @endif
                    {{ Form::text('owFrom', $settings['owFrom']->format('d M Y'), ['id' => 'owFrom', 'class' => 'form-control arrival date', 'style' => 'margin-bottom: 15px']) }}

                    {{ Form::label('date', 'OW to', ['class' => 'control-label']) }}
                    @if ($errors->has('date'))
                        <p class="error-block alert-danger">{{ $errors->first('date') }}</p>
                    @endif
                    {{ Form::text('owTo', $settings['owTo']->format('d M Y'), ['id' => 'owTo', 'class' => 'form-control arrival date', 'style' => 'margin-bottom: 15px']) }}

                    {{ Form::label('electionStreamUrl', 'Link to the election stream', ['class' => 'control-label']) }}
                    @if ($errors->has('electionStreamUrl'))
                        <p class="error-block alert-danger">{{ $errors->first('electionStreamUrl') }}</p>
                    @endif
                    {{ Form::url('electionStreamUrl', $settings['electionStreamUrl'], ['class' => 'form-control', 'style' => 'margin-bottom: 15px']) }}

                    {{ Form::bsSubmit('Update settings') }}

                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <div style="min-height: 250px"></div>
    </div>
@stop

@section('stylesheets')
    @parent
    <link href="{{ URL::asset('/css/picker.css') }}" rel="stylesheet" type="text/css">
@stop

@section('scripts')
    @parent

    <script src="{{ URL::asset('/js/picker.js') }}"></script>
    <script src="{{ URL::asset('/js/picker.date.js') }}"></script>

    <script  type="text/javascript">

        var $inputDate = $('.date').pickadate({
            editable: true,
            firstDay: 1,
            format: 'dd mmm yyyy'
        });
    </script>
    @stop
