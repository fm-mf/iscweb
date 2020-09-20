@extends('partak.settings.layout')

@section('inner-content')
    <div class="container">
        @if(session('successUpdate'))
            <div class="success top-message">
                <i class="fas fa-check mr-1"></i> Opening hours successfully updated
            </div>
        @endif

        {{ Form::model($currentMode, ['route' => 'partak.settings.openingHours', 'method' => 'patch']) }}

        <div class="form-group">
            {{ Form::label('id_opening_hours_mode', 'Opening hours mode', ['class' => 'required']) }}
            {{ Form::select('id_opening_hours_mode', $availableModes, $currentMode->id_opening_hours_mode, ['class' => 'form-control' . ($errors->has('id_opening_hours_mode') ? ' is-invalid' : ''), 'required' => 'required']) }}
            @if($errors->has('id_opening_hours_mode'))
                <div class="invalid-feedback">
                    {{ $errors->first('id_opening_hours_mode') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            {{ Form::label('hours_json[text]', 'Opening hours text') }}
            {{ Form::textarea('hours_json[text]', old('hours_json.text', $currentMode->hours_json['text']), ['class' => 'form-control' . ($errors->has('hours_json.text') ? ' is-invalid' : '')]) }}
            @if($errors->has('hours_json.text'))
                <div class="invalid-feedback">
                    {{ $errors->first('hours_json.text') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            {{ Form::label('hours_json[textCs]', 'Opening hours text (Czech)') }}
            {{ Form::textarea('hours_json[textCs]', old('hours_json.textCs', $currentMode->hours_json['textCs'] ?? ""), ['class' => 'form-control' . ($errors->has('hours_json.textCs') ? ' is-invalid' : ''), 'lang' => 'cs']) }}
            @if($errors->has('hours_json.textCs'))
                <div class="invalid-feedback">
                    {{ $errors->first('hours_json.textCs') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <div class="form-check">
                {{ Form::checkbox('show_hours', '1', $currentMode->show_hours, ['id' => 'show_hours', 'class' => 'form-check-input' . ($errors->has('show_hours') ? ' is-invalid' : '')] ) }}
                {{ Form::label('show_hours', 'Show daily hours', ['class' => 'form-check-label']) }}
                @if($errors->has('show_hours'))
                    <div class="invalid-feedback">
                        {{ $errors->first('show_hours') }}
                    </div>
                @endif
            </div>
        </div>

        @foreach($currentMode->hours_json['hours'] as $day => $hours)
            <div class="form-group row">
                {{ Form::label("hours_json[hours][{$day}]", $day, ['class' => 'col-sm-4 col-md-3 col-lg-2 col-form-label required']) }}
                <div class="col-sm-8 col-md-9 col-lg-10">
                    {{ Form::text("hours_json[hours][{$day}]", old("hours_json.hours.{$day}", $hours), ['class' => 'form-control' . ($errors->has("hours_json.hours.{$day}") ? ' is-invalid' : ''), 'required' => 'required']) }}
                    @if($errors->has("hours_json.hours.{$day}"))
                        <div class="invalid-feedback">
                            {{ $errors->first("hours_json.hours.{$day}") }}
                        </div>
                    @endif
                </div>
            </div>
        @endforeach

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-check"></i> Update Opening hours
            </button>
        </div>

        {{ Form::close() }}
    </div>
@endsection

@section('scripts')
    @parent
    <script src="{{ mix('/js/partak-settings-hours.js') }}" defer="defer"></script>
@stop
