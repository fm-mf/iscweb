@props([
    'key',
    'label',
    'dateTime',
])

<div class="form-group">
    {{ Form::label("{$key}Date", $label) }}

    @if ($errors->hasAny(["{$key}Date", "{$key}Time"]))
        <p class="error-block alert-danger">
            @error("{$key}Date")
                {{ $message }}
            @enderror
            @error("{$key}Time")
                {{ $message }}
            @enderror
        </p>
    @endif

    <div class="row">
        <div class="col-sm-6 mb-2 mb-sm-0">
            {{ Form::text(
                "{$key}Date",
                $dateTime->format('d M Y'),
                ['id' => "{$key}Date", 'class' => 'form-control date']
            ) }}
        </div>
        <div class="col-sm-6">
            {{ Form::text(
                "{$key}Time",
                $dateTime->format('H:i'),
                ['id' => "{$key}Time", 'class' => 'form-control time']
            ) }}
        </div>
    </div>
</div>
