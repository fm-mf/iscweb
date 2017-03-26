<div class="form-group">
    {{ Form::label($name, $label, ['class' => 'control-label ' . $required]) }}
    @if ($errors->has($name))
        <p class="error-block alert-danger">{{ $errors->first($name) }}</p>
    @endif
    {{ Form::number($name, $value, array_merge($required ? ['class' => 'form-control', 'required' => ''] : ['class' => 'form-control'], $attributes)) }}
    <div class="info">{{ $info }}</div>
</div>