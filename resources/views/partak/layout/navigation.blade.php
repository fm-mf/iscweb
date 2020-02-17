<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
    <div class="d-flex flex-grow-1 align-items-center">
        <span class="w-100 d-lg-none"></span>
        <a class="navbar-brand" href="{{ route('partak.index') }}">
            <img src="{{ asset('img/logos/isc-logo-white-color-horizontal.svg') }}" alt="Logo ISC CTU in Prague" />
        </a>
        <span class="w-100 text-right">
            <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </span>
    </div>
    <div class="collapse navbar-collapse" id="navbarNav">
        @include('partak.components.navbar-nav', ['navItems' => [
            ['title' => 'Dashboard', 'route' => 'partak.index'],
            ['title' => 'Users', 'route' => 'partak.users', 'acl' => 'users.view'],
            ['title' => 'Trips', 'route' => 'partak.trips'],
            ['title' => 'Events', 'route' => 'partak.events', 'acl' => 'events.view'],
            ['title' => 'Stats', 'route' => 'partak.stats.index', 'acl' => 'stats.view'],
            ['title' => 'Settings', 'route' => 'partak.settings', 'acl' => 'settings.edit'],
            ['title' => 'Alumni Newsletters', 'route' => 'alumni.newsletters.index', 'acl' => ['alumniNewsletter.create', 'alumniNewsletter.update', 'alumniNewsletter.delete']],
            ['title' => 'Logs', 'route' => 'partak.logs', 'acl' => 'logs'],
        ]])
    </div>
    <div class="collapse navbar-collapse ml-auto flex-grow-0">
        <ul class="nav navbar-nav">
            <li><a href="{{ url('user/logout') }}"><img src="{{ URL::asset( Auth::user()->person->avatar() ) }}" class="img-circle top-navigation-user" />Logout</a></li>
        </ul>
    </div>
</nav>
