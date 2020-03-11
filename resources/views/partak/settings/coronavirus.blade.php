@extends('partak.settings.layout')
@section('inner-content')

    <div class="container">
        <h2>Coronavirus alert settings</h2>

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
            <div class="col-sm-10">
                {{ Form::model($settings, ['id' => 'mainForm', 'url' => 'partak/settings/coronavirus', 'method' => 'patch']) }}
                {{ Form::bsSelect('coronavirusEnabled', 'Coronavirus alert is', ['1' => 'Enabled', '0' => 'Disabled'], $settings['coronavirusEnabled'] ? '1' : '0')  }}

                {{ Form::bsText('title', 'Title', 'required')  }}
                {{ Form::bsTextarea('content', 'Alert content', 'required', null, ['style' => 'height: 500px']) }}
            </div>
        </div>

        <div style="margin-bottom: 15px;">
            <input type="submit" value="Update settings" class="btn btn-primary btn-submit">
        </div>

        {{ Form::close() }}
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
