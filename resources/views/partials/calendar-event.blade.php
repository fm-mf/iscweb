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

        @isset($event->facebook_url)
            <p>
                ► <a href="{{ $event->facebook_url }}" target="_blank" rel="noopener"><strong>@lang('web.calendar.facebook-event')</strong></a>
            </p>
        @endisset
        <p>
            ► <a href="{{ $event->reservation_url }}">
                @if ($event->reservations_enabled && $event->trip && $event->trip->registration_to > \Carbon\Carbon::now())
                    <strong>@lang('web.calendar.online-reservation')</strong>
                @else
                    <strong>@lang('web.calendar.detail')</strong>
                @endif
            </a>
        </p>
    </div>
</li>
