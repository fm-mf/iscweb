<div class="row contact">
    <div class="col-auto">
        @empty($contact['avatar'])
            <span class="fas fa-user fa-6x"></span>
        @else
            <img src="{{ $contact['avatar'] }}" alt="{{ $contact['position'] }}"/>
        @endif
    </div>

    <ol class="col contact-details list-unstyled">
        <li><h5>{{ $contact['name'] }}</h5></li>
        <li><strong>{{ $contact['position'] }}</strong></li>
        <li>@lang('web.Email'): <a href="mailto:{{ $contact['email'] }}">{{ $contact['email'] }}</a></li>
        @if(mb_strlen($contact['phone']) === 16)
            <li>@lang('web.Phone'): <a href="tel:{{ $contact['phone'] }}">{{ str_replace(' ', ' ' /* &nbsp; */, $contact['phone']) }}</a></li>
        @endif
    </ol>
</div>
