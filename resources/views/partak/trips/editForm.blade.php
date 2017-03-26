
{{ Form::bsText('name', 'Name', 'required') }}<script>
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
{{ Form::bsFile('cover', 'Cover', ['accept' => 'image/jpeg, image/png', 'onchange' => 'cover_change(this.files)']) }}
<img id="cover_preview" width="100%" src="{{$event->cover()}}" href="{{$event->cover()}}" style="display: {{$event->hasCover() ? 'block' : 'none'}};"/>
@if(! $trips)
    @if($event->type == 'integreat')
        {{ Form::bsText('countries', 'Countries', '', $event->integreat_party->countries) }}
        {{ Form::bsText('theme', 'Theme', '', $event->integreat_party->theme) }}
    @elseif($event->type == 'languages')
        {{ Form::bsText('where', 'Where', '', $event->languages_event->where) }}
        {{ Form::bsText('where_url', 'Url address from Google Maps', '', $event->languages_event->where_url) }}
    @endif
@endif

<div class="form-group row">
    <div class="col-sm-6 left">
        {{ Form::label('visible_date', 'Visible from date', ['class' => 'control-label required' ]) }}
        @if ($errors->has('visible_date'))
            <p class="error-block alert-danger">{{ $errors->first('visible_date') }}</p>
        @endif
        {{ Form::text('visible_date',($event->visible_from) ? $event->visible_from->format('d M Y') :'', ['id' => 'visible_date', 'class' => 'form-control arrival date']) }}

    </div>
    <div class="col-sm-6 right">
        {{ Form::label('visible_time', 'Visible from time', ['class' => 'control-label required']) }}
        @if ($errors->has('visible_time'))
            <p class="error-block alert-danger">{{ $errors->first('visible_time') }}</p>
        @endif
        {{ Form::text('visible_time', $event->visible_from->format('g:i A'), ['id' => 'visible_time', 'class' => 'form-control arrival time']) }}

    </div>
    <div class="col-sm-6 info"></div>
</div>

<div class="form-group row">
    <div class="col-sm-6 left">
        {{ Form::label('start_date', 'Event starts date', ['class' => 'control-label required']) }}
        @if ($errors->has('start_date'))
            <p class="error-block alert-danger">{{ $errors->first('start_date') }}</p>
        @endif
        {{ Form::text('start_date', $event->datetime_from->format('d M Y'), ['id' => 'start_date', 'class' => 'form-control arrival date']) }}

    </div>
    <div class="col-sm-6 right">
        {{ Form::label('time', 'Event starts time', ['class' => 'control-label required']) }}
        @if ($errors->has('start_time'))
            <p class="error-block alert-danger">{{ $errors->first('start_time') }}</p>
        @endif
        {{ Form::text('start_time', $event->datetime_from->format('g:i A'), ['id' => 'start_time', 'class' => 'form-control arrival time']) }}

    </div>
    <div class="col-sm-6 info"></div>
</div>
@if($trips)
    @include('partak.trips.editFormTrips')
@else
    {{ Form::bsSelect('type', 'Type of event', $types, $event->type)  }}
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
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        };

        tinymce.init(editor_config);
    </script>
@stop