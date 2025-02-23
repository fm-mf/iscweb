<div class="form-group">
    {{ Form::label($name, $label, ['class' => "$required"]) }}
    @if ($errors->has($name))
        <p class="error-block alert-danger">{{ $errors->first($name) }}</p>
    @endif
    @php
        $attrs = '';
        foreach ($attributes as $key => $value) $attrs .= $key . '="' . $value . '"';
    @endphp
    <input type="file" id="{{$name}}" name="{{$name}}" @if ($required) required="required" @endif class="form-control" {!! $attrs !!} >
    <!--{{ Form::file($name, array_merge(['class' => 'form-control'], $attributes)) }}-->
    <div class="info">{{ $info }}</div>
</div>
