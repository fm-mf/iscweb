@extends('web.layouts.activities')

@section('content')
    <div class="container">
    <ul class="row list-unstyled contacts">
        <li class="col-md-4 col-sm-6 col-md-offset-4">
            <img src="{{ $contact['avatar'] }}" class="img-circle">
            <div class="contact-details">
                <h4>{{ $contact['name'] }}</h4><br>
                <strong>{{ $contact['position'] }}</strong><br>
                Email: <a href="mailto:{{ $contact['email'] }}">{{ $contact['email'] }}</a><br>
                @if(mb_strlen($contact['phone']) === 16)
                    Phone: <a href="tel:{{ $contact['phone'] }}">{{ str_replace(' ', '&nbsp;', $contact['phone']) }}</a><br>
                @endif
            </div>
            <span class="clearfix"></span>
        </li>
    </ul>
    <blockquote class="quote-big"><p>Dream. Explore. Learn. Share. Discover.</p></blockquote>
    </div>
@endsection
