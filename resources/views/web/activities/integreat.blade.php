@extends('web.layouts.activities')
@section('content')
    <div class="container subpage">
    	<blockquote><p>Share. Experience. InteGREAT!</p></blockquote>
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1">
                <h2>COUNTRY PRESENTATIONS</h2>
                <p>
                    Every year there are dozens of nationalities coming to Prague. Imagine the variety of cultures, traditions, local customs or cooking practices to discover. That is why we have the inteGREAT team, to give students the opportunity to get familiar with countries of their fellow exchange students and then present their own country in return. Not only is it interesting but it’s also a great place where to meet new friends, international and Czech as well.
                </p>

            </div>
        </div>

        @if(isset($events) && $events->count() > 0)
            <h2 class="align-center">SCHEDULE OF THE {{ $currentSemester }} PRESENTATIONS</h2>

            <center>

                <table class="presentations-list">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Theme</th>
                        <th>Presenting Countries</th>
                        <th>More info</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $integreat)
                            <tr><td>{{ $integreat->event->datetime_from->format('l, jS F') }}</td><td>{{ $integreat->theme }} </td> <td>{{ $integreat->countries }}</td>
                                <td><a {{ isset($integreat->event->facebook_url)? 'href='.$integreat->event->facebook_url : ''  }} target="_blank">Facebook event</a></td></tr>
                        @endforeach

                    </tbody>
                </table>
            </center>
        @endif

        <!--
        <h2 class="align-center">SCHEDULE OF THE SPRING 2015 PRESENTATIONS</h2>

        <center>

            <table class="presentations-list">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Theme</th>
                  <th>Presenting Countries</th>
                  <th>Club</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Tuesday, February 17th</td>
                  <td>9 pm</td>
                  <td>Czech Presentation</td>
                  <td>Czech Republic</td>
                  <td><a href="http://goo.gl/maps/wALZd">P.M. Club</a></td>
                </tr>

                <tr>
                  <td>Thursday, February 26th</td>
                  <td>9 pm</td>
                  <td>RnB & HIP HOP</td>
                  <td>Portugal, Italy, Hungary</td>
                  <td><a href="http://goo.gl/maps/uwtL2">Solidní Jistota</a></td>
                </tr>

                <tr>
                  <td>Wednesday, March 4th</td>
                  <td>9 pm</td>
                  <td>Concert</td>
                  <td>NO presentation!</td>
                  <td><a href="http://goo.gl/maps/2pgmu">Chapeau Rouge</a></td>
                </tr>

                <tr>
                  <td>Wednesday, March 11th</td>
                  <td>9 pm</td>
                  <td>REGGAE</td>
                  <td>Costa Rica, Argentina</td>
                  <td><a href="http://goo.gl/maps/AM60s">Magnum</a></td>
                </tr>

                <tr>
                  <td>Wednesday, March 18th</td>
                  <td>9 pm</td>
                  <td>COMMERCIAL</td>
                  <td>USA, South Korea, Australia</td>
                  <td><a href="http://goo.gl/maps/wALZd">P.M. Club</a></td>
                </tr>

                <tr>
                  <td>Thursday, March 26th</td>
                  <td>9 pm</td>
                  <td>RETRO SWING</td>
                  <td>France, Slovakia, Greece</td>
                  <td><a href="http://goo.gl/maps/wALZd">P.M. Club</a></td>
                </tr>

                <tr>
                  <td>Monday, March 30th</td>
                  <td>9 pm</td>
                  <td>OLDIES</td>
                  <td>Poland, Belgium, China</td>
                  <td><a href="http://goo.gl/maps/2pgmu">Chapeau Rouge</a></td>
                </tr>

                <tr>
                  <td>Wednesday, April 8th</td>
                  <td>9 pm</td>
                  <td>BLUES</td>
                  <td>UK, Canada, Denmark</td>
                  <td><a href="http://goo.gl/maps/wALZd">P.M. Club</a></td>
                </tr>

                <tr>
                  <td>Monday, April 13th</td>
                  <td>9 pm</td>
                  <td>LATINO</td>
                  <td>Spain, Mexico</td>
                  <td><a href="http://goo.gl/maps/Ai7K4">Rock Café</a></td>
                </tr>

                <tr>
                  <td>Thursday, April 23rd</td>
                  <td>9 pm</td>
                  <td>DISCO/TRANCE/POP</td>
                  <td>Russia, Turkey, Taiwan</td>
                  <td><a href="http://goo.gl/maps/unHLl">Strahov Grill Centre</a></td>
                </tr>

                <tr>
                  <td>Wednesday, April 29th</td>
                  <td>9 pm</td>
                  <td>ROCK</td>
                  <td>Germany, Finland, Sweden, Kazakhstan</td>
                  <td><a href="http://goo.gl/maps/wALZd">P.M. Club</a></td>
                </tr>

                <tr>
                  <td>Thursday, May 7th</td>
                  <td></td>
                  <td>BOAT PARTY</td>
                  <td>Farwell party </td>
                  <td></td>
                </tr>

              </tbody>
            </table>
            </center>
        -->

        <!--
        <h2 class="align-center">SCHEDULE OF THE FALL 2014 PRESENTATIONS</h2>

            <center>

            <table class="presentations-list">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Theme</th>
                  <th>Presenting Countries</th>
                  <th>Club</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Monday, September 22nd</td>
                  <td>9 pm</td>
                  <td>Czech Presentation</td>
                  <td>Czech Republic</td>
                  <td><a href="http://goo.gl/maps/wALZd">P.M. Club</a></td>
                </tr>
                <tr>
                  <td>Thursday, October 2nd</td>
                  <td>9 pm</td>
                  <td>Mountain Lovers</td>
                  <td>Germany, Italy, Slovenia</td>
                  <td><a href="http://goo.gl/maps/AM60s">Magnum</a></td>
                </tr>
                <tr>
                  <td>Wednesday, October 8th</td>
                  <td>9 pm</td>
                  <td>See the Seas</td>
                  <td>Taiwan, Bulgaria, South Korea, Poland</td>
                  <td><a href="http://goo.gl/maps/wALZd">P.M. Club</a></td>
                </tr>
                <tr>
                  <td>Thursday, October 16th</td>
                  <td>9:30 pm</td>
                  <td>4-Uni Carnival Party</td>
                  <td>-</td>
                  <td><a href="http://goo.gl/maps/yFbPi">Retro Music Hall</a></td>
                </tr>
                <tr>
                  <td>Thursday, October 23rd</td>
                  <td>9 pm</td>
                  <td>Civilised Oldies</td>
                  <td>Greece, China, Mexico, Turkey</td>
                  <td><a href="http://goo.gl/maps/uwtL2">Solidní Jistota</a></td>
                </tr>
                <tr>
                  <td>Wednesday, October 29th</td>
                  <td>9 pm</td>
                  <td>Explorers</td>
                  <td>Spain, Portugal, Argentina</td>
                  <td><a href="http://goo.gl/maps/Ai7K4">Rock Café</a></td>
                </tr>
                <tr>
                  <td>Wednesday, November 5th</td>
                  <td>9 pm</td>
                  <td>Red Light, Green Light</td>
                  <td>Netherlands, Lithuania</td>
                  <td><a href="http://goo.gl/maps/AM60s">Magnum</a></td>
                </tr>
                <tr>
                  <td>Wednesday, November 12th</td>
                  <td>9 pm</td>
                  <td>Queen's Favourites</td>
                  <td>Canada, Scotland, Australia, India</td>
                  <td><a href="http://goo.gl/maps/wALZd">P.M. Club</a></td>
                </tr>
                <tr>
                  <td>Wednesday, November 19th</td>
                  <td>9 pm</td>
                  <td>Breakfast Club</td>
                  <td>Belgium, Denmark, Finland</td>
                  <td><a href="http://goo.gl/maps/2pgmu">Chapeau Rouge</a></td>
                </tr>
                <tr>
                  <td>Wednesday, November 26th</td>
                  <td>9 pm</td>
                  <td>AA Party</td>
                  <td>Moldova, Russia, France, Slovakia</td>
                  <td><a href="http://goo.gl/maps/wALZd">P.M. Club</a></td>
                </tr>
                <tr>
                  <td>Wednesday, December 3rd</td>
                  <td>9 pm</td>
                  <td>Farewell Party - Oscars</td>
                  <td>USA</td>
                  <td><a href="http://goo.gl/maps/wALZd">P.M. Club</a></td>
                </tr>
                </tbody>
            </table>

            </center>

        -->


        <ul class="gallery-row list-unstyled row">
            <li class="col-sm-4 col-lg-3">
                <a href="{{ url('/img/web/activities/presentations/presentations-1.jpg') }}" data-lightbox="sports"><img src="{{ asset('/img/web/activities/presentations/presentations-1-t.jpg') }}"></a>
            </li>
            <li class="col-sm-4 col-lg-3">
                <a href="{{ url('/img/web/activities/presentations/presentations-2.jpg') }}" data-lightbox="sports"><img src="{{ asset('/img/web/activities/presentations/presentations-2-t.jpg') }}"></a>
            </li>
            <li class="col-sm-4 col-lg-3">
                <a href="{{ url('/img/web/activities/presentations/presentations-3.jpg') }}" data-lightbox="sports"><img src="{{ asset('/img/web/activities/presentations/presentations-3-t.jpg') }}"></a>
            </li>
            <li class="col-sm-4 col-lg-3">
                <a href="{{ url('/img/web/activities/presentations/presentations-4.jpg') }}" data-lightbox="sports"><img src="{{ asset('/img/web/activities/presentations/presentations-4-t.jpg') }}"></a>
            </li>
            <li class="col-sm-4 col-lg-3">
                <a href="{{ url('/img/web/activities/presentations/presentations-5.jpg') }}" data-lightbox="sports"><img src="{{ asset('/img/web/activities/presentations/presentations-5-t.jpg') }}"></a>
            </li>
        </ul>
        <h2>You can find more photos on facebook page <a href="https://www.facebook.com/inteGREATParty/photos_stream">inteGREAT</a></h2>
    </div>

    <div>
	    <ul class="row list-unstyled contacts activities-contacts">
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
	</div>
@endsection
