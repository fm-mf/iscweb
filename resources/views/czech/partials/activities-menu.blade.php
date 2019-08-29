<section class="activities-menu">
    <div class="container menu">
        <ul class="row list-unstyled">
            <li class="col-sm-4{{ request()->routeIs('czech.activities.languages') ? ' active' : '' }}">
                <a href="{{ route('czech.activities.languages')  }}">
                    <img src="{{ asset('img/web/languages.jpg') }}" />
                    <span class="menu-arrow fas fa-chevron-circle-down fa-4x"></span>
                    <span class="menu-title">Jazyky</span>
                    <span class="menu-active fas fa-caret-down fa-5x"></span>
                </a>
            </li>
            <li class="col-sm-4{{ request()->routeIs('czech.activities.trips') ? ' active' : '' }}">
                <a href="{{ route('czech.activities.trips') }}">
                    <img src="{{ asset('img/web/trips.jpg') }}" />
                    <span class="menu-arrow fas fa-chevron-circle-down fa-4x"></span>
                    <span class="menu-title">Výlety</span>
                    <span class="menu-active fas fa-caret-down fa-5x"></span>
                </a>
            </li>
            <li class="col-sm-4{{ request()->routeIs('czech.activities.inteGREAT') ? ' active' : '' }}">
                <a href="{{ route('czech.activities.inteGREAT') }}">
                    <img src="{{ asset('img/web/presentations.jpg') }}" />
                    <span class="menu-arrow fas fa-chevron-circle-down fa-4x"></span>
                    <span class="menu-title">inteGREAT</span>
                    <span class="menu-active fas fa-caret-down fa-5x"></span>
                </a>
            </li>
        </ul>
    </div>
</section>
