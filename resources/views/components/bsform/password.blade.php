<div class="form-group">
    {{ Form::label($name, $label, ['class' => 'control-label']) }}
    @if ($errors->has($name))
        <p class="error-block alert-danger">{{ $errors->first($name) }}</p>
    @endif
    {{ Form::password($name, array_merge(['class' => 'form-control'], $attributes)) }}
    <p class="help-block">{{ $info }}</p>
</div>