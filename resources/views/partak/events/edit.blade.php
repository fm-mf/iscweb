@extends('partak.events.layout')
@section('inner-content')

    @if(session('successUpdate'))
        <div class="row">
            <div class="row-inner">
                <div class="success">
                    <span class="glyphicon glyphicon-ok" style="padding-right:5px;"></span>{{ session('successUpdate') }}
                </div>
            </div>
        </div>
    @endif


    <div class="container">
        <div class="row row-inner" id="form">
            <div class="col-md-7">
                <h2>Edit event</h2>
                {{ Form::model($event, ['url' => 'partak/events/edit/'. $event->id_event, 'method' => 'patch', 'id' => 'form']) }}

                @include('partak.trips.editForm',['trips' => false])

                {{ Form::bsSubmit('Update event') }}

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

    <script src="{{ URL::asset('/js/picker.js') }}"></script>
    <script src="{{ URL::asset('/js/picker.date.js') }}"></script>
    <script src="{{ URL::asset('/js/picker.time.js') }}"></script>

    <script  type="text/javascript">

        var $inputDate = $('.date').pickadate({
            editable: true,
            firstDay: 1,
            format: 'dd mmm yyyy'
        });

        //var picker = $inputDate.pickadate('picker');
        //picker.set('view', new Date({!$date}));
        var $inputTime = $('.time').pickatime({
            editable: true
        });
    </script>
@stop