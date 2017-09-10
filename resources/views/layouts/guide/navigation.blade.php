<nav class="navbar">
    <div class="container">

        <button type="button" class="navbar-toggle pull-left" id="menu-button" data-toggle="collapse" data-target=".navbar-main-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href=""><h1>Survival Guide</h1></a>
    </div>
</nav>
<div class="container-fluid">
    <div id="left-column" class="container">
        <div id="sg-title-bg"></div>
        <div id="sg-title" class="row">
            <a href="{{ url('guide') }}">
                <h1>Survival Guide<br>
                    <small>will guide you through your stay at ctu</small>
                </h1>
            </a>
        </div>
        <div class="row menu">
            <ul class="nav nav-stacked">
                <li class="blue"><a href="{{ url ('guide/first-steps') }}">First steps</a>
                    <ul class="nav nav-stacked">
                        <li><a href="{{ url('guide/introduction') }}">Introduction</a></li>
                        <li><a href="{{ url('guide/welcome-pack') }}">Welcome pack</a></li>
                        <li><a href="{{ url('guide/orientation-week') }}">Orientation week</a></li>
                        <li><a href="{{ url('guide/cards') }}">Cards</a></li>
                        <li><a href="{{ url('guide/kos') }}">KOS &amp; Classes registration</a></li>
                        <li><a href="{{ url('guide/eduroam') }}">Eduroam</a></li>
                    </ul>
                </li>
                <li class="purple"><a href="{{url('guide/about-ctu')}}">CTU &amp; Useful information</a>
                    <ul class="nav nav-stacked">
                        <li><a href="{{ url('guide/academic-year') }}">Academic year calendar</a></li>
                        <li><a href="{{ url('guide/campus') }}">Campus</a></li>
                        <li><a href="{{ url('guide/dormitories') }}">Dormitories</a></li>
                        <li><a href="{{ url('guide/isc-esn') }}">ISC &amp; ESN</a></li>
                    </ul>
                </li>
                <li class="green"><a href="{{ url('guide/czech-it-out') }}">Czech it out!</a>
                    <ul class="nav nav-stacked">
                        <li><a href="{{ url('guide/visa') }}">Visa</a></li>
                        <li><a href="{{ url('guide/health-care') }}">Health care</a></li>
                        <li><a href="{{ url('guide/living-in-prague') }}">Living in Prague</a></li>
                        <li><a href="{{ url('guide/transportation') }}">Transportation</a></li>
                        <li><a href="{{ url('guide/money-exchange') }}">Money exchange</a></li>
                        <li><a href="{{ url('guide/post-office') }}">Post office</a></li>
                        <li><a href="{{ url('guide/phone') }}">Phone</a></li>
                        <li><a href="{{ url('guide/culture-shock') }}">Culture shock</a></li>
                        <li><a href="{{ url('guide/czech-phrases') }}">Czech phrases</a></li>
                        <li><a href="{{ url('guide/funny-facts') }}">Funny facts</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div><!-- left column -->
</div><!-- /container-fluid -->