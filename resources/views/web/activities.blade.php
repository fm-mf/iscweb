@extends('web.layouts.activities')

@section('content')
    <div class="container">
    <ul class="row list-unstyled contacts">
        <li class="col-md-4 col-sm-6 col-md-offset-4">
            <img src="{{ asset('img/web/contacts/2018-spring/activities-vasek.jpg') }}" class="img-circle">
            <div class="contact-details">
                <h4>Václav David</h4><br>
                <strong>Activities Coordinator</strong><br>
                Email: <a href="mailto:activities@isc.cvut.cz">activities@isc.cvut.cz</a><br>
                Phone: <a href="tel:+420 731 858 146">+420 731 858 146</a><br>
            </div>
            <span class="clearfix"></span>
        </li>
    </ul>
    <blockquote class="quote-big"><p>Dream. Explore. Learn. Share. Discover.</p></blockquote>
    </div>
@endsection
