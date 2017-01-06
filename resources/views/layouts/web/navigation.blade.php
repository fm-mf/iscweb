<!------------------------------ Logo and navigation ----------------------------------->
<nav class="navbar navbar-custom navbar-main @yield('navClass')" role="navigation">
    <div class="container">
        <div class="row">
            <div class="navbar-header col-sm-3">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ URL::asset('web/img/logo.png') }}" id="logo" alt="International Student Club">
                </a>
            </div><!-- /.navbar-header -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse col-sm-9">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a href="{{ url('/') }}" class="current">HOME</a>
                    </li>
                    <li>
                        <a href="{{ url('/about-us') }}">ABOUT US</a>
                    </li>
                    <li>
                        <a href="{{ url('/buddy-program/') }}">BUDDY PROGRAM</a>
                    </li>
                    <li>
                        <a href="{{ url('/activities/') }}">ACTIVITIES</a>
                    </li>
                    <li>
                        <a href="{{ url('/calendar/') }}">CALENDAR</a>
                    </li>
                    <li>
                        <a href="{{ url('/contact/') }}">CONTACTS</a>
                    </li>
                    <!--
                    <li>
                        <a href="//www.isc.cvut.cz/partak" target="_blank">ParťákNet</a>
                    </li>
                    -->
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.row -->
        <!-- Language selection (uncomment after the Czech version is available)
        <div class="row">
            <div class="col-xs-12">
                    <ul class="list-inline" style="text-align:right;">
                    <li><a href="#"><img src="/img/cz.png"></a></li>
                    <li><a href="#"><img src="/img/en.png"></a></li>
                </ul>
            </div>
        </div>
        -->
    </div><!-- /.container -->
</nav>