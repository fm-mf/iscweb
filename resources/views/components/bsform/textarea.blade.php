<div class="form-group">
    @if ($label)
    {{ Form::label($name, $label, ['class' => 'control-label '. $required]) }}
    @endif
    @if ($errors->has($name))
        <p class="error-block alert-danger">{{ $errors->first($name) }}</p>
    @endif
    {{ Form::textarea($name, $value, array_merge(['class' => 'form-control'], $attributes)) }}
    <div class="info">{{ $info }}</div>
</div>