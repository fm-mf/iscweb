<div class="form-group">
    {{ Form::label($name, $label, ['class' => 'control-label']) }}
    {{ Form::password($name, array_merge(['class' => 'form-control'], $attributes)) }}
    <div class="col-sm-6 info">{{ $info }}</div>
</div>