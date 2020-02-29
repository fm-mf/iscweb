@extends('partak.trips.layout')
@section('inner-content')

    @if(session('success'))
        <div class="success top-message">
            <i class="fas fa-check mr-1"></i>{{ session('success') }}
        </div>
    @endif


    <div class="container" id="form">
        <h2>Edit trip <a href="{{ url('partak/trips/detail/' . $trip->id_trip) }}" role="button" class="btn btn-info btn-xs">Detail</a></h2>

        {{ Form::model($event, ['url' => 'partak/trips/edit/'. $trip->id_trip, 'method' => 'patch', 'id' => 'form', 'files' => true]) }}

        @include('partak.trips.editForm',['trips' => true])

        {{ Form::bsSubmit('Update event') }}

        {{ Form::close() }}
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