<div class="form-group">
    @if ($label)
    {{ Form::label($name, $label, ['class' => 'control-label']) }}
    @endif
    @if ($errors->has($name))
        <p class="error-block alert-danger">{{ $errors->first($name) }}</p>
    @endif
        <?php
            $class = 'form-control';
            if (key_exists('class', $attributes)) {
                $class = $class . ' ' .$attributes['class'];
                unset($attributes['class']);
            }
        ?>
    {{ Form::select($name, $options, $value, array_merge(['class' => $class], $attributes)) }}
    <p class="info-block">{{ $info }}</p>
</div>