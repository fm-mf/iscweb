@extends('web.layouts.activities')
@section('content')
    <div class="container subpage">
        <ul class="row list-unstyled contacts">
            <li class="col-md-4 col-sm-6 col-md-offset-4">
                <img src="{{ asset('img/web/contacts/2017spring/Sports_Petr.jpg') }}"class="img-circle">
                <div class="contact-details">
                    <h4>Petr Šlajs</h4><br>
                    <strong>Sports Coordinator</strong><br>
                    Email: <a href="mailto:sports@isc.cvut.cz">sports@isc.cvut.cz</a><br>
                    Phone: (+420) 724 537 680<br>
                </div>
                <span class="clearfix"></span>
            </li>
        </ul>
        <blockquote><p>Just play. Have fun. Enjoy the game.</p><p><small>Michael Jordan</small></p></blockquote>
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1">
                <p>
                    Do you like sport? Would you like to play football, basketball, volleyball or other? ISC organizes sport
                    events every week. The level of sport classes depends on your participation and propositions.
                    No matter if you are a professional or if you would like to try a new sport. To enroll in any sport,
                    follow partial instructions or just contact supervising person (instructor). Some of the sports are
                    for free, some are paid for.
                </p>
                <p>
                    In any case, you can contact ISC Sport coordinator Petr Šlajs (<a href="mailto:sports@isc.cvut.cz">sports@isc.cvut.cz</a>).
                </p>
                <p>
                    If the choice of sport events is not enough various for you, you can come up with your idea and you
                    can even organize your sport classes. If you would like to do so, contact ISC Sport coordinator please.
                </p>
                <p>
                    There is a Facebook group for each of the sport. Please, join the yours to follow the current instructions and situation.
                </p>

                <p><strong><big>All sports are starting during 1st and 2nd week of the semester</big></strong></p>


                <!-- ------------------------ SPORTS SCHEDULE picture ------------------------------------------------- -->

                <!--
                          <center>
                          <img src="../img/web/activities/sports/sports_schedule1.png" width="800" height="645" />
                          </center>
                -->

                <!-- ------------------------ SPORTS detailed info ------------------------------------------------- -->
                <!-- <h2 class="align-center">Schedule for SPRING 2017 comming soon…</h2> <br> -->

                <h2 class="align-center">Schedule for SPRING 2017</h2>

                <div class="container sports-list">
                    <ul class="row list-unstyled contacts">
                        <li class="col-md-5 col-sm-6">
                            <h3>Football</h3>

                            <b>When:</b> Sunday 21:00 - 23:00<br>
                            <b>Where:</b> <a href="https://goo.gl/maps/6eWgvNXyNiP2">Pod Juliskou Sports Center</a><br>
                            <b>Meeting point:</b> at 20:40 in the lobby of <a href="https://goo.gl/maps/OCtHW">Masarykova dormitory</a><br>
                            <b>Price:</b> 50 Kč, for ISC members 30Kč<br>
                            <b>Contact person:</b>Srini Vasan, Sakthi Shakz<br>
                            <b>What to bring:</b> indoor shoes and sport clothes<br>
                            <b>Facebook:</b> <a href="https://www.facebook.com/groups/1494986440518838/">join our group</a>

                        </li>

                        <li class="col-md-5 col-sm-6">
                            <h3>Tennis</h3>
                            <b>When:</b> Sunday 18:00 – 19:00<br>
                            <b>Where:</b> <a href="https://goo.gl/maps/e8mY1xMwFnn">Kotlářka Sport center</a><br>
                            <b>Price:</b> 70 Kč, for ISC members 50Kč<br>
                            <b>Contact person:</b> Lucie Marcalíková <br>
                            <b>What to bring:</b> Tennis shoes and sport clothes. Racket and balls can be borrowed. <br>
                            <b>Facebook:</b> <a href="https://www.facebook.com/groups/316398321879089/">join our group</a>
                        </li>
                    </ul>
                    <ul class="row list-unstyled contacts">
                        <li class="col-md-5 col-sm-6">
                            <h3>Floorball</h3>
                            <b>When:</b> Thursday 17:00 – 18:00<br>
                            <b>Meeting point:</b> at 20:40 in the lobby of <a href="https://goo.gl/maps/OCtHW">Masarykova dormitory</a><br>
                            <b>Where:</b> <a href="http://www.utvs.cvut.cz/en/sports-pod-juliskou.html">"Pod Juliskou" Sports Center</a><br>
                            <b>Price:</b> 50 Kč, for ISC members 30Kč<br>
                            <b>Contact person:</b> Matěj Kamenický <br>
                            <b>What to bring:</b> indoor shoes a sport clothes <br>
                            <b>Facebook:</b> <a href="https://www.facebook.com/groups/isc.floorball">join our group</a><br><br>
                        </li>


                        <li class="col-md-5 col-sm-6">
                            <h3>Salsa</h3>

                            <b>When:</b> Tuesday 20:00 – 22:00<br>
                            <b>Where:</b> <a href="https://goo.gl/maps/OCtHW">Masarykova dormitory</a>, room R605 (J623)<br>
                            <b>Price:</b> Free! <br>
                            <b>Contact person:</b> Veronika Dušková<br>
                            <b>What to bring:</b> comfortable shoes and clothes<br>
                            <b>Facebook:</b> <a href="https://www.facebook.com/groups/328139057395194">join our group</a>
                        </li>
                    </ul>
                    <ul class="row list-unstyled contacts">
                        <li class="col-md-5 col-sm-6">
                            <h3>Volleyball</h3>
                            <b>When:</b> Monday 20:30 - 22:00 <br>
                            <b>Where:</b> <a href="https://goo.gl/maps/6eWgvNXyNiP2">"Pod Juliskou" Sports Center</a><br>
                            <b>Price:</b> 40 Kč, for ISC members 20Kč<br>
                            <b>Contact person:</b> David Mládek<br>
                            <b>What to bring:</b> indoor shoes and sport clothes<br>
                            <b>Facebook:</b> <a href="https://www.facebook.com/groups/426942574167221/">join our group</a>

                        </li>

                        <li class="col-md-5 col-sm-6">
                            <h3>Basketball</h3>
                            <b>Time and place:</b> follow fb group<br>
                            <b>Contact person:</b> Mario Dzurman <br>
                            <b>What to bring:</b> indoor shoes and sport clothes. <br>
                            <b>Facebook:</b> <a href="https://www.facebook.com/groups/573672776173969">join our group</a>
                        </li>
                    </ul>
                    <ul class="row list-unstyled contacts">

                        <li class="col-md-5 col-sm-6">
                            <h3>Bachata</h3>
                            <b>When:</b> Wednesday 20:00 – 21:30<br>
                            <b>Where:</b> <a href="https://goo.gl/maps/OCtHW">Masarykova dormitory</a>, room R605 (J623)<br>
                            <b>Price:</b> Free! <br>
                            <b>Contact person:</b> Sergiu Adrian Rus <br>
                            <b>What to bring:</b> comfortable shoes and clothes<br>
                            <b>Facebook:</b> <a href="https://www.facebook.com/groups/1424689370896554/">join our group</a>
                        </li>
                    </ul>
                </div>

        <!-- -----------------------Schedule Fall 2016 -----------------------------------------

                <h2 class="align-center">Schedule for FALL 2016</h2>

            </div>

            <div class="container sports-list">
                <ul class="row list-unstyled contacts">


                    <li class="col-md-4 col-sm-6">
                        <h3>Badminton</h3>

                        <b>When:</b> variable, follow <a href="https://www.facebook.com/groups/badminton.ISC/">Facebook group</a><br>
                        <b>Where:</b> variable<br>
                        <b>Price:</b> 40-100 CZK<br>
                        <b>What to bring:</b> sport shoes, sport clothes, racquet & shuttlecocks (it is also possible to borrow them on spot)<br>
                        <b>Contact person:</b> Verča Řasová<br>
                        <b>Facebook:</b> <a href="https://www.facebook.com/groups/badminton.ISC/">join our group</a>
                    </li>

                    <!--                <li class="col-md-4 col-sm-6">
                                      <h3>Bike trips</h3>

                                      Distance 30-60 km, it depends on requirements of participants<br>
                                      <b>When:</b> variable, follow <a href="https://www.facebook.com/groups/798309716957534/">Facebook group</a><br>
                                      <b>Meeting point:</b> in front of <a href="https://goo.gl/maps/OCtHW">Masarykova dormitory</a><br>
                                      <b>Contact person:</b> Lucka Marcalíková<br>
                                      <b>Price for renting bike:</b> 300 CZK (+1000 CZK as deposit) for 1 day<br>
                                    </li>


                    <li class="col-md-4 col-sm-6">
                        <h3>Football</h3>

                        <b>When:</b> Sunday 21:00 - 23:00<br>
                        <b>Where:</b> <a href="https://goo.gl/maps/6eWgvNXyNiP2">Pod Juliskou Sports Center</a><br>
                        <b>Meeting point:</b> at 20:40 in the lobby of <a href="https://goo.gl/maps/OCtHW">Masarykova dormitory</a><br>
                        <b>Price:</b> 50 CZK / 30 CZK for ISC members<br>
                        <b>Contact person:</b> Florin Buffon<br>
                        <b>What to bring:</b> indoor shoes and sport clothes<br>
                        <b>Facebook:</b> <a href="https://www.facebook.com/groups/1494986440518838/">join our group</a>

                    </li>

                    <li class="col-md-4 col-sm-6">
                        <h3>Salsa</h3>

                        <b>When:</b> Tuesday 20:00 - 22:00, starting 18th October<br>
                        <b>Where:</b> <a href="https://goo.gl/maps/OCtHW">Masarykova dormitory</a>, room R605 (J623)<br>
                        <b>Price:</b> Free! <br>
                        <b>Registration:</b> not required, just show up<br>
                        <b>Contact person:</b> Veronika Dušková<br>
                        <b>What to bring:</b> comfortable shoes and clothes<br>
                        <b>Facebook:</b> <a href="https://www.facebook.com/groups/328139057395194">join our group</a>
                    </li>

                </ul>
                <ul class="row list-unstyled contacts">

                    <li class="col-md-4 col-sm-6">
                        <h3>Swimming</h3>
                        <b>When:</b> follow <a href="https://www.facebook.com/groups/1489685074692466/">Facebook group</a><br>
                        <b>Where:</b> <a href="https://goo.gl/maps/uG4rszRjSDH2">Swimming pool Suchdol</a><br>
                        <b>Price:</b> variable<br>
                        <b>Contact person:</b> Lucie Marcalíková<br>
                        <b>Facebook:</b> <a href="https://www.facebook.com/groups/1489685074692466/">join our group</a>
                    </li>

                    <li class="col-md-4 col-sm-6">
                        <h3>Swing</h3>
                        <b>When:</b> Thursday 20:00 - 22:00<br>
                        <b>Where:</b> <a href="https://goo.gl/maps/OCtHW">Masarykova dormitory</a>, room B305<br>
                        <b>Price:</b> Free!<br>
                        <b>Contact person:</b> Felix Kirchhoff<br>
                        <b>Facebook:</b> <a href="https://www.facebook.com/groups/605938712918580/">join our group</a>
                    </li>

                    <li class="col-md-4 col-sm-6">
                        <h3>Tennis</h3>
                        <b>When:</b> variable, follow <a href="https://www.facebook.com/groups/316398321879089/">Facebook group</a><br>
                        <b>Where:</b> <a href="https://goo.gl/maps/e8mY1xMwFnn">Kotlářka Sport center</a><br>
                        <b>Price:</b> depends on number of players<br>
                        <b>Contact person:</b> Lucie Marcalíková <br>
                        <b>What to bring:</b> Tennis shoes and sport clothes. Racket and balls can be borrowed. <br>
                        <b>Facebook:</b> <a href="https://www.facebook.com/groups/316398321879089/">join our group</a>
                    </li>

                </ul>
                <ul class="row list-unstyled contacts">

                    <li class="col-md-4 col-sm-6">
                        <h3>Volleyball</h3>
                        <b>When:</b> Monday 20:30 - 22:00 <br>
                        <b>Where:</b> <a href="https://goo.gl/maps/6eWgvNXyNiP2">Pod Juliskou Sports Center</a><br>
                        <b>Price:</b> 40 CZK / 20 CZK for ISC members <br>
                        <b>Contact person:</b> Dimitar Mitev<br>
                        <b>What to bring:</b> indoor shoes and sport clothes<br>
                        <b>Facebook:</b> <a href="https://www.facebook.com/groups/426942574167221/">join our group</a>

                    </li>

                    -->

                <!-- ----------------------------- stare sporty SPRING 2015 ------------------------------------------------

                  <li class="col-md-4 col-sm-6">
                  <h3>Angentine tango</h3>
                  every Thursday @ 19:00-21:00<br>
                  in Masarykova dormitory, room J623<br>
                  <b>Price:</b> Free! <br>
                  <b>Registration:</b> not required<br>
                              <b>Contact person:</b> Vadim Onufriev (ovavadim[at]gmail.com)<br>
                  <b>Information:</b> We'll create interesting evenings and will have fun. The melodies, the embraces and the tango atmosphere.
            Let's do it together.
            If you don't know how to dance -- come and you WILL be able. If you already can -- come and let's organise a milonga!
            We'll have meetings every week! <br>
                  <b>What to bring:</b> comfortable shoes and clothes<br>
                  <b>Facebook:</b> <a href="https://www.facebook.com/groups/BallroomCVUT/">join our group</a>
                </li>




                <li class="col-md-4 col-sm-6">
                  <h3>Basketball</h3>
                  every Thursday @ 22:00-23:00 (from <b>March 5th</b>)<br>
          in Juliska Sport Center<br>
      <b>Price:</b> 50 CZK<br>
                  <b>Contact person:</b> Miodrag Ignjatovic (miodrag.ig[at]gmail.com) <br>
      <b>What to bring:</b> sport shoes and sport clothes. <br>
      <b>Facebook:</b> <a href="https://www.facebook.com/groups/isc.ctu.Basketball">join our group</a>
                </li>





    <li class="col-md-4 col-sm-6">
                  <h3>Football</h3>
      every Sunday @ 20:00 <br>
                  at Strahov, pitch 3<br>
                  <b>Price:</b> 20 CZK (with ESN card)<br>
                  <b>Contact person:</b> Vašek (petrzva1[at]fit.cvut.cz)<br>
                  <b>Information:</b> For more information join our <a href="https://www.facebook.com/groups/iscfootball">FB group</a>.<br>
                  <b>Registration:</b> <a href="http://doodle.com/mg95eth8hud9h5sm">at this link</a> <br>
      <b>Facebook:</b> <a href="https://www.facebook.com/groups/iscfootball">join our group</a>
                </li>


                <li class="col-md-4 col-sm-6">
                  <h3>University Floorball League - ISC Team</h3>
                  once a week, times updated weekly! <br>
                  in Juliska Sport Center<br>
      <b>Information:</b> comming soon

                  <b>Price:</b> 300 CZK/player/season<br>
                  <b>Contact person:</b> Jirka Borovec (jiri.borovec[at]fel.cvut.cz)<br>
                  <b>What to bring:</b> sport shoes, floorball stick (if you have, otherwise you can borrow one from us)<br>
                  <b>Registration:</b> register <a href="http://ufl.cz/fakultniliga/prihlaska.php">here</a> as ISC Team member


                </li>


    <li class="col-md-4 col-sm-6">
                  <h3>Fitness</h3>
                  every Tuesday @ 20:00-21:00<br>
          in Masarykova dormitory, room J282<br>
                  <b>Contact person:</b> Ladislav Kabíček (l.kabicekISC[at]centrum.cz) <br>
                  <b>Information:</b> Have you put on some weight after partying every day on Erasmus? Do you want an effective weapon in fighting your stubborn belly fat? Come and experience one of the best ways
of losing fat while improving your fitness level. We will do 25 minutes of non-stop no-rest HIIT (high intensity interval training), which will put your body to its limits. <br>
          <b>What to bring:</b> towel (you will sweat a lot), water (or anything you want to drink, but not sugary drinks) and most importantly power of will.<br>
          <b>Facebook:</b> <a href="https://www.facebook.com/groups/581141468682034">join our group</a>
                </li>

                <li class="col-md-4 col-sm-6">
                  <h3>Jogging</h3>
                 every Tuesday @ 18:30 <br>
                  meeting in Masarykova lobby<br>
                  <b>Price:</b> Free!<br>
                  <b>Contact:</b> Radek Filip (radomir.filip[at]gmail.com)<br>
          <b>Facebook:</b> <a href="https://www.facebook.com/groups/727420683944397">join our group</a>
                </li>

    <li class="col-md-4 col-sm-6">
                  <h3>Climbing</h3>
                  every Monday @ 18:30 - 23:00 <br>
                  in Ruzyně Climbing Center, Prague 6<br>
                  <b>Information:</b> <a href="https://docs.google.com/document/d/1zFgBHfQcQ1vpOFGA_aJ53SzfOgZA6zEliz8tPzUYBOs/edit?usp=sharing">here in the info-sheet</a><br>
                  <b>Price:</b> <a href="https://docs.google.com/document/d/1zFgBHfQcQ1vpOFGA_aJ53SzfOgZA6zEliz8tPzUYBOs/edit?usp=sharing">here in the info-sheet</a><br>
      <b>What to bring:</b> if you don't have climbing equipment, you can rent it at the spot<br>
      <b>Contact person:</b> Petr Šimandl, p.simandl86[at]gmail.com, +420 606 228 168<br>
                  <b>Registration:</b> <a href="https://docs.google.com/document/d/1zFgBHfQcQ1vpOFGA_aJ53SzfOgZA6zEliz8tPzUYBOs/edit?usp=sharing">here in the info-sheet</a>
                </li>
            </div>

              -->

                </ul>
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