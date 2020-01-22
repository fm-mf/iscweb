<li class="row event">
    <div class="col-sm-6 header" style="background-image: url({{ $event->coverUrl }})">
        <div class="row">
            <ol class="col-4 list-unstyled start-date">
                <li class="day-of-week">{{ $event->datetime_from->formatLocalized('%A') }}</li>
                @if(strcasecmp(app()->getLocale(), 'cs') === 0)
                    <li class="day-of-month">{{ $event->datetime_from->formatLocalized('%e.') }}</li>
                @elseif (strcasecmp(app()->getLocale(), 'en') === 0)
                    <li class="day-of-month">{{ $event->datetime_from->formatLocalized('%e') }}</li>
                @endif
                <li class="month">{{ $event->datetime_from->formatLocalized('%B') }}</li>
                <li class="time">{{ $event->datetime_from->formatLocalized('%k:%M') }}</li>
            </ol>
            <h3 class="col name">{{ $event->name }}</h3>
        </div>
    </div>
    <div class="col-sm-6 description">
        {!! $event->description !!}

        @if (isset($event->facebook_url) || $event->reservations_hash)
        <p>
            @isset($event->facebook_url)
                ► <a href="{{ $event->facebook_url }}" target="_blank" rel="noopener"><strong>@lang('web.calendar.facebook-event')</strong></a><br />
            @endif
            ► <a href="{{ url("/event/{$event->reservations_hash}") }}">
            @if ($event->reservations_enabled)
                <strong>@lang('web.calendar.online-reservation')</strong>
            @else
                <strong>@lang('web.calendar.detail')</strong>
            @endif
            </a>
        </p>
        @endif
    </div>
</li>
