@extends('web.layouts.activities')
@section('content')
    <div class="container subpage">
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
        <blockquote><p>Just play. Have fun. Enjoy the game.</p><p><small>Michael Jordan</small></p></blockquote>
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1">
                <p>Do you like playing football, basketball, volleyball or even floorball?
                    If you want to practice such sports even in Prague, you can do so every week
                    mostly at Juliska sport center &ndash; all you need is to check the current
                    situation (activities/sports on this website), come, and play.</p>
                <p>There are several sports organized throughout the semester for international
                    and Czech students. The level of sport events depends a lot on your
                    participation and propositions.</p>
                <p>To enroll to any sport, follow partial instructions or just contact
                    the supervising person (instructor).
                    Some of the sports are for free, some are payed.</p>
                <p>You can as well contact the Sports coordinator, <strong>Vojtěch Kubica</strong>
                    (<a href="mailto:sports@isc.cvut.cz">sports@isc.cvut.cz</a>).
                    If you don't receive an answer, just write once again, please.</p>
                <p>If you are missing a sport in the list of available sports,
                    please contact the sport coordinator.</p>
                <p>In order to assess the interest in a sport,
                    please join the group of the chosen sport on Facebook.</p>

                <p><strong>All sports are starting during the 1st and 2nd week of the semester.</strong></p>

{{--
                <!-- ------------------------ SPORTS SCHEDULE picture ------------------------------------------------- -->

                <!--
                          <center>
                          <img src="../img/web/activities/sports/sports_schedule1.png" width="800" height="645" />
                          </center>
                -->

                <!-- ------------------------ SPORTS detailed info ------------------------------------------------- -->

                <h2 class="align-center">Schedule for Spring 2018 comming soon…</h2>
--}}
                <h2 class="align-center">Schedule for Spring 2018</h2>

                <div class="container sports-list">
                    <ul class="row list-unstyled contacts">
                        <li class="col-md-5 col-sm-6">
                            <h3>Football</h3>
                            <b>When:</b> Sunday 21:00 &ndash; 23:00<br>
                            <b>Where:</b> <a href="https://goo.gl/maps/teK4WH75a2p" target="_blank">&quot;Pod Juliskou&quot; Sports Center</a> (Pod Juliskou 4, Prague 6)<br>
                            <b>Meeting point:</b> at 20:40 in the lobby of the <a href="https://goo.gl/maps/cV8kVJogz1F2" target="_blank">Masarykova dormitory</a><br>
                            <b>Price:</b> CZK 50, for ISC members CZK 30<br>{{--
                            <b>Contact person:</b> Felix Richardson<br>--}}
                            <b>What to bring:</b> indoor shoes and sport clothes<br>
                            <b>Facebook:</b> <a href="https://www.facebook.com/groups/1494986440518838/" target="_blank">join our group</a>
                        </li>

                        <li class="col-md-5 col-sm-6">
                            <h3>Tennis</h3>
                            <b>When:</b> Sunday 18:00 &ndash; 19:00<br>
                            <b>Where:</b> <a href="https://goo.gl/maps/qgU164AewvM2" target="_blank">Kotlářka Sport center</a> (Na Kotlářce 7, Prague 6)<br>
                            <b>Price:</b> CZK 70, for ISC members CZK 50<br>
                            <b>Contact person:</b> Lucie Marcalíková<br>
                            <b>What to bring:</b> Tennis shoes and sport clothes. Racket and balls can be borrowed.<br>
                            <b>Facebook:</b> <a href="https://www.facebook.com/groups/316398321879089/" target="_blank">join our group</a>
                        </li>
                    </ul>
                    <ul class="row list-unstyled contacts">
                        <li class="col-md-5 col-sm-6">
                            <h3>Basketball</h3>
                            <b>When:</b> Wednesday 20:30 &ndash; 22:00<br>
                            <b>Where:</b> <a href="https://goo.gl/maps/NirGfLFhER32" target="_blank">Primary School &ndash; ZŠ Bílá</a> (Bílá 1, Prague 6)<br>
                            <b>Meeting point:</b> at 20:15 in the lobby of the <a href="https://goo.gl/maps/cV8kVJogz1F2" target="_blank">Masarykova dormitory</a><br>
                            <b>Price:</b> CZK 40, for ISC members CZK 20<br>
                            <b>Contact person:</b> Tereza Kadlecová<br>
                            <b>What to bring:</b> indoor shoes and sport clothes<br>
                            <b>Facebook:</b> <a href="https://www.facebook.com/groups/104953563666355/" target="_blank">join our group</a>
                        </li>

                        <li class="col-md-5 col-sm-6">
                            <h3>Floorball</h3>
                            <b>When:</b> Thursday 21:00 &ndash; 22:30<br>
                            <b>Where:</b> <a href="https://goo.gl/maps/teK4WH75a2p" target="_blank">&quot;Pod Juliskou&quot; Sports Center</a> (Pod Juliskou 4, Prague 6)<br>
                            <b>Price:</b> CZK 50, for ISC members CZK 30<br>
                            <b>Contact person:</b> Matěj Kamenický<br>
                            <b>What to bring:</b> indoor shoes a sport clothes <br>
                            <b>Facebook:</b> <a href="https://www.facebook.com/groups/isc.floorball/" target="_blank">join our group</a><br><br>
                        </li>
                    </ul>
                    <ul class="row list-unstyled contacts">
                        <li class="col-md-5 col-sm-6">
                            <h3>Salsa</h3>
                            <b>When:</b> Tuesday 19:30 &ndash; 21:00<br>
                            <b>Where:</b> <a href="https://goo.gl/maps/cV8kVJogz1F2" target="_blank">Masarykova dormitory, room R605</a> (Thákurova 550/1, Prague 6)<br>
                            <b>Price:</b> Free!<br>
                            <b>Contact person:</b> Jose Palacios<br>
                            <b>Facebook:</b> <a href="https://www.facebook.com/groups/328139057395194/" target="_blank">join our group</a>
                        </li>
                        <li class="col-md-5 col-sm-6">
                            <h3>Volleyball</h3>
                            <b>When:</b> Monday 20:30 &ndash; 22:00 <br>
                            <b>Where:</b> <a href="https://goo.gl/maps/teK4WH75a2p" target="_blank">&quot;Pod Juliskou&quot; Sports Center</a> (Pod Juliskou 4, Prague 6)<br>
                            <b>Price:</b> CZK 40, for ISC members CZK 20<br>
                            <b>Contact person:</b> David Mládek<br>
                            <b>What to bring:</b> indoor shoes and sport clothes<br>
                            <b>Facebook:</b> <a href="https://www.facebook.com/groups/426942574167221/" target="_blank">join our group</a>

                        </li>
                    </ul>
                </div>
            </div>
            <ul class="gallery-row list-unstyled row">
                <li class="col-sm-4 col-lg-3">
                    <a href="{{ url('/img/web/activities/sports/sports-2.jpg') }}" data-lightbox="sports"><img src="{{ asset('/img/web/activities/sports/sports-2-t.jpg') }}"></a>
                </li>
                <li class="col-sm-4 col-lg-3">
                    <a href="{{ url('/img/web/activities/sports/sports-3.jpg') }}" data-lightbox="sports"><img src="{{ asset('/img/web/activities/sports/sports-3-t.jpg') }}"></a>
                </li>
                <li class="col-sm-4 col-lg-3">
                    <a href="{{ url('/img/web/activities/sports/sports-8.jpg') }}" data-lightbox="sports"><img src="{{ asset('/img/web/activities/sports/sports-8-t.jpg') }}"></a>
                </li>
                <li class="col-sm-4 col-lg-3">
                    <a href="{{ url('/img/web/activities/sports/sports-12.jpg') }}" data-lightbox="sports"><img src="{{ asset('/img/web/activities/sports/sports-12-t.jpg') }}"></a>
                </li>
                <li class="col-sm-4 col-lg-3">
                    <a href="{{ url('/img/web/activities/sports/sports-13.jpg') }}" data-lightbox="sports"><img src="{{ asset('/img/web/activities/sports/sports-13-t.jpg') }}"></a>
                </li>
                <li class="col-sm-4 col-lg-3">
                    <a href="{{ url('/img/web/activities/sports/sports-4.jpg') }}" data-lightbox="sports"><img src="{{ asset('/img/web/activities/sports/sports-4-t.jpg') }}"></a>
                </li>
                <li class="col-sm-4 col-lg-3">
                    <a href="{{ url('/img/web/activities/sports/sports-9.jpg') }}" data-lightbox="sports"><img src="{{ asset('/img/web/activities/sports/sports-9-t.jpg') }}"></a>
                </li>
                <li class="col-sm-4 col-lg-3">
                    <a href="{{ url('/img/web/activities/sports/sports-11.jpg') }}" data-lightbox="sports"><img src="{{ asset('/img/web/activities/sports/sports-11-t.jpg') }}"></a>
                </li>
            </ul>
        </div>
    </div>
@endsection
