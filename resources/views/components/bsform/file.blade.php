<div class="form-group">
    {{ Form::label($name, $label, ['class' => 'control-label']) }}
    @if ($errors->has($name))
        <p class="error-block alert-danger">{{ $errors->first($name) }}</p>
    @endif
    <input type="file" name="{{$name}}" class="form-control">
    <!--{{ Form::file($name, array_merge(['class' => 'form-control'], $attributes)) }}-->
    <div class="info">{{ $info }}</div>
</div>