@extends('web.layouts.activities')

@section('content')
    <div class="container">
    <ul class="row list-unstyled contacts">
        <li class="col-md-4 col-sm-6 col-md-offset-4">
            <img src="{{ asset('img/web/contacts/2017spring/Activities_Misa.jpg') }}" class="img-circle">
            <div class="contact-details">
                <h4>Míša Petříková</h4><br>
                <strong>Activities Coordinator</strong><br>
                Email: <a href="mailto:activities@isc.cvut.cz">activities@isc.cvut.cz</a><br>
                Phone: (+420) 777 888 704<br>
            </div>
            <span class="clearfix"></span>
        </li>
    </ul>
    <blockquote class="quote-big"><p>Dream. Explore. Learn. Share. Discover.</p></blockquote>
    </div>
@endsection