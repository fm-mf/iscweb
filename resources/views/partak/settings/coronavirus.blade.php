@extends('partak.settings.layout')
@section('inner-content')

    <div class="container">
        <h2>Coronavirus alert settings</h2>

        <div class="row">
            <div class="col-sm-10">     
                @if(session('successUpdate'))
                    <div class="success top-message">
                        <i class="fas fa-check mr-1"></i>Settings was successfully updated.
                    </div>
                @endif

                {{ Form::model($settings, ['id' => 'mainForm', 'url' => 'partak/settings/coronavirus', 'method' => 'patch']) }}

                {{ Form::bsSelect('coronavirusEnabled', 'Coronavirus alert is', ['1' => 'Enabled', '0' => 'Disabled'], $settings['coronavirusEnabled'] ? '1' : '0')  }}
                {{ Form::bsText('title', 'Title', 'required')  }}
                {{ Form::bsTextarea('content', 'Alert content', 'required', null, ['style' => 'height: 500px']) }}
                {{ Form::bsSubmit('Update settings') }}

                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop

@section('scripts')
    @parent

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
