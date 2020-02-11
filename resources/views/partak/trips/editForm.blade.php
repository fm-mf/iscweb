<div class="row">
    <div class="col-sm-8">
        {{ Form::bsText('name', 'Name', 'required') }}
    </div>
    <div class="col-sm-4">
        {{ Form::bsSelect('id_semester', 'Semester', $semesters, $currentSemesterId, ['required' => 'required']) }}
    </div>
</div>

<script>
    function cover_change(files) {
        var preview = $('#cover_preview')[0];
        if (files.length <= 0) {
            preview.src = preview.getAttribute('href');
            if (preview.src == '') {
                preview.style.display = 'none';
            }
            return;
        }
        var reader = new FileReader();
        reader.onload = function () {
            preview.src = reader.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(files[0]);
    }
</script>

@if(! isset($create) || $create == false)
    @can('acl', 'details.view')
        <div class="form-group row">
            <div class="col-sm-5 left">
                {{ Form::bsText('createdby', 'Created By', '', $event->createdby ? $event->createdby->person->getFullName() : '', ['readonly' => '', 'required' => '']) }}
            </div>
            <div class="col-sm-5 left">
                {{ Form::bsText('createdat', 'Created at', '', $event->created_at, ['readonly' => '']) }}
            </div>
            <div class="col-sm-2 left">
                <div>
                    <label></label>
                </div>
                <a href="{{ $event->createdby ?  $event->createdby->getDetailLink() : '' }}" role="button" class="btn btn-info btn-xs">Detail</a>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-5 left">
                {{ Form::bsText('modifiedby', 'Modified By', '', $event->modifiedby ? $event->modifiedby->person->getFullName() : '', ['readonly' => '', 'required' => '']) }}
            </div>
            <div class="col-sm-5 left">
                {{ Form::bsText('updatedat', 'Last Modify at', '', $event->updated_at, ['readonly' => '']) }}
            </div>
            <div class="col-sm-2 left">
                <div>
                    <label></label>
                </div>
                <a href="{{ $event->modifiedby ? $event->modifiedby->getDetailLink() : '' }}" role="button" class="btn btn-info btn-xs">Detail</a>
            </div>
        </div>
    @endcan
@endif

{{ Form::bsFile('cover', 'Cover', ['accept' => 'image/jpeg, image/png image/jpg', 'onchange' => 'cover_change(this.files)']) }}
<img id="cover_preview" width="100%" src="{{$event->cover()}}" href="{{$event->cover()}}" style="display: {{$event->hasCover() ? 'block' : 'none'}};"/>
@if(! $trips)
    @if($event->event_type == 'integreat')
        {{ Form::bsText('countries', 'Countries', '', $event->integreat_party->countries) }}
        {{ Form::bsText('theme', 'Theme', '', $event->integreat_party->theme) }}
    @endif
@endif

<div class="row">
    <div class="col-sm-6">
        {{ Form::bsText('location', 'Where', '', $event->location) }}
    </div>
    <div class="col-sm-6">
        {{ Form::bsText('location_url', 'Where (URL)', '', $event->location_url) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('visible_date', 'Visible from', ['class' => 'control-label required' ]) }}
    @if ($errors->has('visible_date'))
        <p class="error-block alert-danger">{{ $errors->first('visible_date') }}</p>
    @endif
    @if ($errors->has('visible_time'))
        <p class="error-block alert-danger">{{ $errors->first('visible_time') }}</p>
    @endif
    <div class="row date-row">
        <div class="col-sm-6">{{ Form::text('visible_date',($event->visible_from) ? $event->visible_from->format('d M Y') :'', ['id' => 'visible_date', 'class' => 'form-control arrival date', 'required' => 'required']) }}</div>
        <div class="col-sm-6">{{ Form::text('visible_time', $event->visible_from->format('g:i A'), ['id' => 'visible_time', 'class' => 'form-control arrival time', 'required' => 'required']) }}</div>
    </div>
</div>

<div class="row">
    <div class="form-group col-sm-6">
        {{ Form::label('start_date', 'Event starts', ['class' => 'control-label required']) }}
        @if ($errors->has('start_date'))
            <p class="error-block alert-danger">{{ $errors->first('start_date') }}</p>
        @endif
        @if ($errors->has('start_time'))
            <p class="error-block alert-danger">{{ $errors->first('start_time') }}</p>
        @endif
        <div class="row date-row">
            <div class="col-sm-6">{{ Form::text('start_date', $event->datetime_from->format('d M Y'), ['id' => 'start_date', 'class' => 'form-control arrival date', 'required' => 'required']) }}</div>
            <div class="col-sm-6">{{ Form::text('start_time', $event->datetime_from->format('g:i A'), ['id' => 'start_time', 'class' => 'form-control arrival time', 'required' => 'required']) }}</div>
        </div>
    </div>
    @if ($trips)
    <div class="form-group col-sm-6">
        {{ Form::label('date', 'Event ends', ['class' => 'control-label required']) }}
        @if ($errors->has('date'))
            <p class="error-block alert-danger">{{ $errors->first('date') }}</p>
        @endif
        @if ($errors->has('time'))
            <p class="error-block alert-danger">{{ $errors->first('time') }}</p>
        @endif
        <div class="row date-row">
            <div class="col-sm-6">{{ Form::text('end_date', $trip->trip_date_to->format('d M Y'), ['id' => 'end_date', 'class' => 'form-control arrival date', 'required' => 'required']) }}</div>
            <div class="col-sm-6">{{ Form::text('end_time', $trip->trip_date_to->format('g:i A'), ['id' => 'end_time', 'class' => 'form-control arrival time', 'required' => 'required']) }}</div>
        </div>
    </div>
    @endif
</div>

@if($trips)
    @include('partak.trips.editFormTrips')
@else
    {{ Form::bsSelect('event_type', 'Type of event', $event_types, $event->event_type)  }}
@endif

{{ Form::bsUrl('facebook_url', 'Facebook event (url)') }}

{{ Form::bsTextarea('description', 'Description (in English)', 'required') }}


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

    <script src="{{ URL::asset('/js/tinymce/tinymce.min.js') }}"></script>
    <script>
        var editor_config = {
            path_absolute: "{{ URL::asset('/') }}/",
            selector: "textarea",
            plugins: [
                "advlist autolink lists link",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime table contextmenu directionality",
                "paste textpattern"
            ],
            toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link",
        };

        tinymce.init(editor_config);
    </script>
@stop
