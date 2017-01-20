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
            <h1>SURVIVAL GUIDE<br>
                <small>WILL GUIDE YOU THROUGH YOUR STAY AT CTU</small>
            </h1>
        </div>
        <div class="row menu">
            <ul class="nav nav-stacked">
                <li class="blue"><a href="{{ url ('guide/basic-information') }}">First days in Prague</a>
                    <ul class="nav nav-stacked">
                        <li><a href="{{ url('guide/legal-information') }}">Legal information</a></li>
                        <li><a href="{{ url('guide/orientation-week') }}">Orientation Week</a></li>
                        <li><a href="{{ url('guide/international-office') }}">International Office</a></li>
                    </ul>
                </li>
                <li class="purple"><a href="{{url('guide/about-CTU')}}">Studying at CTU</a>
                    <ul class="nav nav-stacked">
                        <li><a href="{{ url('guide/useful-information') }}">Useful Information</a></li>
                        <li><a href="{{ url('guide/contact-list') }}">Contact list</a></li>
                        <li><a href="{{ url('guide/ISC') }}">International Student Club</a></li>
                        <li><a href="{{ url('guide/CTU-dormitories') }}">CTU Dormitories</a></li>
                        <!--<li><a href="#">Dejvice Campus Map</a></li>-->
                    </ul>
                </li>
                <li class="green"><a href="{{ url('guide/leisure-time') }}">Living in Prague</a>
                    <ul class="nav nav-stacked">
                        <li><a href="{{ url('guide/getting-around') }}">Getting around the city</a></li>
                        <li><a href="{{ url('guide/private-accommodation') }}">Private accommodation</a></li>
                        <li><a href="{{ url('guide/health-care') }}">Health Care</a></li>
                        <li><a href="{{ url('guide/basic-vocabulary') }}">Basic vocabulary</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div><!-- left column -->
</div><!-- /container-fluid -->