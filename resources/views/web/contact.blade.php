@extends('web.layouts.layout')
@section('navClass', 'navbar-dark')
@section('page')
    <div id="map-canvas"></div>
    <div class="contact-wrapper">
        @include('web.layouts.navigation')

    <div class="container">
        <div class="row link-map visible-xs align-center">
            <div class="col-sm-12">
                <a href="https://www.google.com/maps/place/International+Student+Club+CTU+in+Prague/@50.1010161,14.3872774,17z/data=!4m8!1m2!2m1!1sinternational+student+club+ctu+in+prague!3m4!1s0x470b953c0f37a36f:0x6d538d168df03b66!8m2!3d50.1006367!4d14.3869159"> <button type="button" class="btn btn-primary">Find us on Google maps</button></a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 col-sm-6">

            </div>

            <div class="contact-info col-md-4 col-sm-6 opening-hours">
                <h2>See when we're in the ISC Point:<!--<br><i>Subject to be extended later</i>--></h2>

                <p>{!! $openingHoursText !!}</p>

                {!! $openingHoursTable !!}

            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-sm-6"></div>
            <div class="contact-info col-md-4 col-sm-6">

                <h2>Where can you find our ISC Point?</h2>
                <b>International&nbsp;Student&nbsp;Club CTU&nbsp;in&nbsp;Prague</b><br>
                Masarykova&nbsp;Dormitory, room&nbsp;304&nbsp;(red)<br>
                Thákurova&nbsp;550/1<br>
                160&nbsp;00 Praha&nbsp;6<br>
            </div>
        </div>
    </div>
    </div>

    <!--------------------- Contact information ---------------------------------------------------->
    <div class="our-contatcts-wrapper">
        <div class="container our-contacts">
            <div class="row">
                <div class="col-sm-3"><h2>Our Contacts:</h2></div>
                <div class="col-sm-3">

                    <span class="glyphicon glyphicon-earphone"></span>
                    <strong>Phone:</strong> <a href="tel:+420 775 198 605">+420&nbsp;775&nbsp;198&nbsp;605</a>

                </div>
                <div class="col-sm-3">
                    <span class="glyphicon glyphicon-envelope"></span>
                    <strong>Email:</strong> <a href="mailto:isc@isc.cvut.cz">isc@isc.cvut.cz</a>
                </div>
                <div class="col-sm-3"><span class="glyphicon glyphicon-thumbs-up"></span><strong>Facebook: </strong><a href="https://www.facebook.com/isc.ctu.prague">isc.ctu.prague</a></div>
            </div>
        </div>
    </div>
    <!--------------------- Coordinators ---------------------------------------------------->
    <div class="container">
        <div class="page">
            <div class="row">
                <div class="col-md-5 col-sm-5"><h2 style="text-align:right">Our billing address:</h2></div>
                <div class="contact-info col-md-4 col-sm-6">

                    <b>International&nbsp;Student&nbsp;Club CTU&nbsp;in&nbsp;Prague,&nbsp;z.s.</b>
                    <br>
                    Thákurova&nbsp;550/1,&nbsp; 160&nbsp;00 Praha&nbsp;6<br>
                    IČO:&nbsp;22841032<br>
                </div>
            </div>
            <h1>OUR COORDINATORS</h1>
            <div class="container">
                <ul class="row list-unstyled contacts">
                    @foreach($contacts as $contact)
                        <li class="col-md-4 col-sm-6">
                            @if(isset($contact['avatar']) && $contact["avatar"] != "")
                                <img src="{{ $contact['avatar'] }}" class="img-circle">
                            @else
                                <i class="fas fa-user img-circle" style="font-size: 90px;
                                    float: left;
                                    text-align: center;
                                    width: 104px;
                                    height: 104px;"></i>
                            @endif
                            <div class="contact-details">
                                <h4>{{ $contact['name'] }}</h4><br>
                                <strong>{{ $contact['position'] }}</strong><br>
                                Email: <a href="mailto:{{ $contact['email'] }}">{{ $contact['email'] }}</a><br>
                                @if($contact->phone_visible)
                                    Phone: <a href="tel:{{ $contact['phone'] }}">{{ $contact['phoneWithSpaces'] }}</a><br>
                                @endif
                            </div>
                            <span class="clearfix"></span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="row quote">
            <blockquote>
                <p>Together we conquer the world.</p>
            </blockquote>
        </div>
    </div>
@endsection

@section('javascript')
    @parent
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9ZNFKyW2aiHfQNqt0mv79uHOvUt92gxU"></script>
    <script type="text/javascript">
        function initialize() {
            var myLatlng = new google.maps.LatLng(50.100532, 14.386943);
            var mapOptions = {
                center: new google.maps.LatLng(50.104634, 14.457110),
                zoom: 13,
                scrollwheel: false,
                disableDefaultUI: true,
                zoomControl: true,
            };
            var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
            var image = '/img/web/marker.png';
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                icon: image,
                title: 'ISC center'
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
@endsection
