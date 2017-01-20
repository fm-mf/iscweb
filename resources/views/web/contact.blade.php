@extends('layouts.web.layout')
@section('navClass', 'navbar-dark')
@section('page')
    <div id="map-canvas"></div>
    <div class="contact-wrapper">
        @include('layouts.web.navigation')

    <div class="container">
        <div class="row link-map visible-xs align-center">
            <div class="col-sm-12">
                <a href="https://www.google.com/maps/place/International+Student+Club+CTU+in+Prague/@50.084071,14.4119155,14z/data=!4m5!1m2!2m1!1sinternational+student+club+ctu+in+prague!3m1!1s0x470b953c0f37a36f:0x6d538d168df03b66"> <button type="button" class="btn btn-primary">Find us on Google maps</button></a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 col-sm-6">

            </div>

            <div class="contact-info col-md-4 col-sm-6 opening-hours">
                <h2>See when we're in the ISC Point:<!--<br><i>Subject to be extended later</i>--></h2>
                <span class="show-menu"></span>

                There are no regular opening hours during the exam period. The ISC Point will be open from February 8th.

               <!-- <table>
                    <tr>
                        <th>Monday</th>
                        <td>14:00 - 22:00</td>
                    </tr>
                    <tr>
                        <th>Tuesday</th>
                        <td>14:00 - 22:00</td>
                    </tr>
                    <tr>
                        <th>Wednesday</th>
                        <td>14:00 - 22:00</td>
                    </tr>
                    <tr>
                        <th>Thursday</th>
                        <td>14:00 - 20:00</td>
                    </tr>
                    <tr>
                        <th>Friday</th>
                        <td>closed</td>
                    </tr>
                    <tr>
                        <th>Saturday</th>
                        <td>closed</td>
                    </tr>
                    <tr>
                        <th>Sunday</th>
                        <td>closed</td>
                    </tr>
                </table> -->

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
                    <strong>Phone:</strong> +420&nbsp;775&nbsp;198&nbsp;605

                </div>
                <div class="col-sm-3">
                    <span class="glyphicon glyphicon-envelope"></span>
                    <strong>Email:</strong> isc@isc.cvut.cz
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
                    <li class="col-md-4 col-sm-6">
                        <img src="{{ URL::asset('img/web/contacts/2016fall/president.jpg') }}" class="img-circle">
                        <div class="contact-details">
                            <h4>Tereza Vlasáková</h4><br>
                            <strong>President</strong><br>
                            Email: <a href="mailto:president@isc.cvut.cz">president@isc.cvut.cz</a><br>
                            Phone: (+420) 604 208 172<br>
                        </div>
                        <span class="clearfix"></span>
                    </li>
                    <li class="col-md-4 col-sm-6">
                        <img src="{{ URL::asset('img/web/contacts/2016fall/vice.jpg') }}" class="img-circle">
                        <div class="contact-details">
                            <h4>Erik Derner</h4><br>
                            <strong>Vicepresident</strong><br>
                            Email: <a href="mailto:vicepresident@isc.cvut.cz">vicepresident@isc.cvut.cz</a><br>
                            Phone: (+420) 720 224 489<br>
                        </div>
                        <span class="clearfix"></span>
                    </li>
                    <li class="col-md-4 col-sm-6">
                        <img src="{{ URL::asset('img/web/contacts/2016fall/hr.jpg') }}" width="100px" class="img-circle">
                        <div class="contact-details">
                            <h4>Martin Mastný</h4><br>
                            <strong>Human Resources</strong><br>
                            Email: <a href="mailto:hr@isc.cvut.cz">hr@isc.cvut.cz</a><br>
                            Phone: (+420) 720 236 883<br>
                        </div>
                        <span class="clearfix"></span>
                    </li>
                    <li class="col-md-4 col-sm-6">
                        <img src="{{ URL::asset('img/web/contacts/2016fall/treasurer.jpg') }}" class="img-circle">
                        <div class="contact-details">
                            <h4>Daniel Pleschner</h4><br>
                            <strong>Treasurer</strong><br>
                            Email: <a href="mailto:treasurer@isc.cvut.cz">treasurer@isc.cvut.cz</a><br>
                            Phone: (+420) 725 020 470<br>
                        </div>
                        <span class="clearfix"></span>
                    </li>
                    <li class="col-md-4 col-sm-6">
                        <img src="{{ URL::asset('img/web/contacts/2016fall/pr.jpg') }}" class="img-circle">
                        <div class="contact-details">
                            <h4>Eva Machová</h4><br>
                            <strong>Public Relations</strong><br>
                            Email: <a href="mailto:pr@isc.cvut.cz">pr@isc.cvut.cz</a><br>
                            Phone: (+420) 736 724 862<br>
                        </div>
                        <span class="clearfix"></span>
                    </li>
                    <li class="col-md-4 col-sm-6">
                        <img src="{{ URL::asset('img/web/contacts/2016fall/interel.jpg') }}" class="img-circle">
                        <div class="contact-details">
                            <h4>Jan Cejhon</h4><br>
                            <strong>International Relations</strong><br>
                            Email: <a href="mailto:interel@isc.cvut.cz">interel@isc.cvut.cz</a><br>
                            Phone: (+420) 606 418 602<br>
                        </div>
                        <span class="clearfix"></span>
                    </li>
                    <li class="col-md-4 col-sm-6">
                        <img src="{{ URL::asset('img/web/contacts/2016fall/knowledge.jpg') }}" class="img-circle">
                        <div class="contact-details">
                            <h4>Vít Skolil</h4><br>
                            <strong>Quality and Knowledge Manager</strong><br>
                            Email: <a href="mailto:knowledge@isc.cvut.cz">knowledge@isc.cvut.cz</a><br>
                            Phone: (+420) 608 036 167<br>
                        </div>
                        <span class="clearfix"></span>
                    </li>
                    <li class="col-md-4 col-sm-6">
                        <img src="{{ URL::asset('img/web/contacts/2016fall/integreat.jpg') }}" class="img-circle">
                        <div class="contact-details">
                            <h4>Ondřej Väter</h4><br>
                            <strong>inteGREAT Coordinator</strong><br>
                            Email: <a href="mailto:integreat@isc.cvut.cz">integreat@isc.cvut.cz</a><br>
                            Phone: (+420) 777 874 575<br>
                        </div>
                        <span class="clearfix"></span>
                    </li>
                    <li class="col-md-4 col-sm-6">
                        <img src="{{ URL::asset('img/web/contacts/2016fall/point.jpg') }}" class="img-circle">
                        <div class="contact-details">
                            <h4>Denis Lom</h4><br>
                            <strong>Point Coordinator</strong><br>
                            Email: <a href="mailto:point@isc.cvut.cz">point@isc.cvut.cz</a><br>
                            Phone: (+420) 731 872 630<br>
                        </div>
                        <span class="clearfix"></span>
                    </li>
                    <li class="col-md-4 col-sm-6">
                        <img src="{{ URL::asset('img/web/contacts/2016fall/activities.jpg') }}" class="img-circle">
                        <div class="contact-details">
                            <h4>Lucie Marcalíková</h4><br>
                            <strong>Activities Coordinator</strong><br>
                            Email: <a href="mailto:activities@isc.cvut.cz">activities@isc.cvut.cz</a><br>
                            Phone: (+420) 732 131 321<br>
                        </div>
                        <span class="clearfix"></span>
                    </li>
                    <li class="col-md-4 col-sm-6">
                        <img src="{{ URL::asset('img/web/contacts/2016fall/languages.jpg') }}" class="img-circle">
                        <div class="contact-details">
                            <h4>Eva Málková</h4><br>
                            <strong>Languages Coordinator</strong><br>
                            Email: <a href="mailto:languages@isc.cvut.cz">languages@isc.cvut.cz</a><br>
                            Phone: (+420) 736 212 824<br>
                        </div>
                        <span class="clearfix"></span>
                    </li>
                    <li class="col-md-4 col-sm-6">
                        <img src="{{ URL::asset('img/web/contacts/2016fall/buddy.jpg') }}" class="img-circle">
                        <div class="contact-details">
                            <h4>Tereza Kadlecová</h4><br>
                            <strong>Buddy Coordinator</strong><br>
                            Email: <a href="mailto:buddy@isc.cvut.cz">buddy@isc.cvut.cz</a><br>
                            Phone: (+420) 607 708 082<br>
                        </div>
                        <span class="clearfix"></span>
                    </li>
                    <li class="col-md-4 col-sm-6">
                        <img src="{{ URL::asset('img/web/contacts/2016fall/it.jpg') }}" class="img-circle">
                        <div class="contact-details">
                            <h4>Martin Průcha</h4><br>
                            <strong>IT Coordinator</strong><br>
                            Email: <a href="mailto:it@isc.cvut.cz">it@isc.cvut.cz</a><br>
                            Phone: (+420) 736 683 644<br>
                        </div>
                        <span class="clearfix"></span>
                    </li>
                    <li class="col-md-4 col-sm-6">
                        <img src="{{ URL::asset('img/web/contacts/2016fall/alumni.jpg') }}" class="img-circle">
                        <div class="contact-details">
                            <h4>Soňa Cicoňová</h4><br>
                            <strong>Alumni Coordinator</strong><br>
                            Email: <a href="mailto:alumni@isc.cvut.cz">alumni@isc.cvut.cz</a><br>
                            Phone: (+420) 731 128 197<br>
                        </div>
                        <span class="clearfix"></span>
                    </li>
                    <li class="col-md-4 col-sm-6">
                        <img src="{{ URL::asset('img/web/contacts/2016fall/sports.jpg') }}" class="img-circle">
                        <div class="contact-details">
                            <h4>Jiří Vejrosta</h4><br>
                            <strong>Sports Coordinator</strong><br>
                            Email: <a href="mailto:sports@isc.cvut.cz">sports@isc.cvut.cz</a><br>
                            Phone: (+420) 724 662 462<br>
                        </div>
                        <span class="clearfix"></span>
                    </li>
                    <li class="col-md-4 col-sm-6">
                        <img src="{{ URL::asset('img/web/contacts/2016fall/care.jpg') }}" class="img-circle">
                        <div class="contact-details">
                            <h4>Dominik Bureš</h4><br>
                            <strong>ISC Care Coordinator</strong><br>
                            Email: <a href="mailto:care@isc.cvut.cz">care@isc.cvut.cz</a><br>
                            Phone: (+420) 721 421 299<br>
                        </div>
                        <span class="clearfix"></span>
                    </li>
                    <li class="col-md-4 col-sm-6">
                        <img src="{{ URL::asset('img/web/contacts/2016fall/visa.jpg') }}" class="img-circle">
                        <div class="contact-details">
                            <h4>Šimon Hrabec</h4><br>
                            <strong>Visa Coordinator</strong><br>
                            Email: <a href="mailto:visa@isc.cvut.cz">visa@isc.cvut.cz</a><br>
                            Phone: (+420) 732 334 216<br>
                        </div>
                        <span class="clearfix"></span>
                    </li>
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
                zoom: 12,
                scrollwheel: false,
                disableDefaultUI: true,
                zoomControl: true,
            };
            var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
            var image = '/img/marker.png';
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