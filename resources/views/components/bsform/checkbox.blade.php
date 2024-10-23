<div class="form-group">
    {{ Form::label($name, $label, ['class' => "$required"]) }}
    @if ($errors->has($name))
        <p class="error-block alert-danger">{{ $errors->first($name) }}</p>
    @endif
    {{ Form::checkbox($name, $value, $checked, array_merge($required ? ['required' => ''] : [], $attributes)) }}
    <div class="info">{{ $info }}</div>
</div>
