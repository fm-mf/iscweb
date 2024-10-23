<div class="form-group">
    {{ Form::label($name, $label) }}
    @if ($errors->has($name))
        <p class="error-block alert-danger">{{ $errors->first($name) }}</p>
    @endif
    {{ Form::password($name, array_merge(['class' => 'form-control'], $attributes)) }}
    <small class="form-text text-muted">{{ $info }}</small>
</div>
