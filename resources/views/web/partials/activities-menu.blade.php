<section class="activities-menu">
    <div class="container menu">
        <ul class="row list-unstyled">
            <li class="col-sm-3{{ request()->routeIs('web.activities.languages') || request()->routeIs('web.activities.index') ? ' active' : '' }}">
                <a href="{{ route('web.activities.languages')  }}">
                    <img src="{{ asset('img/web/languages.jpg') }}" />
                    <span class="menu-arrow fas fa-chevron-circle-down fa-4x"></span>
                    <span class="menu-title">Language programs</span>
                </a>
            </li>
            <li class="col-sm-3{{ request()->routeIs('web.activities.sports') || request()->routeIs('web.activities.index') ? ' active' : '' }}">
                <a href="{{ route('web.activities.sports') }}">
                    <img src="{{ asset('img/web/sports.jpg') }}" />
                    <span class="menu-arrow fas fa-chevron-circle-down fa-4x"></span>
                    <span class="menu-title">Sports</span>
                </a>
            </li>
            <li class="col-sm-3{{ request()->routeIs('web.activities.integreat') || request()->routeIs('web.activities.index') ? ' active' : '' }}">
                <a href="{{ route('web.activities.integreat') }}">
                    <img src="{{ asset('img/web/presentations.jpg') }}" />
                    <span class="menu-arrow fas fa-chevron-circle-down fa-4x"></span>
                    <span class="menu-title">inteGREAT</span>
                </a>
            </li>
            <li class="col-sm-3{{ request()->routeIs('web.activities.trips') || request()->routeIs('web.activities.index') ? ' active' : '' }}">
                <a href="{{ route('web.activities.trips') }}">
                    <img src="{{ asset('img/web/trips.jpg') }}" />
                    <span class="menu-arrow fas fa-chevron-circle-down fa-4x"></span>
                    <span class="menu-title">Trips</span>
                </a>
            </li>
        </ul>
    </div>
</section>