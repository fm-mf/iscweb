<nav class="partak-nav navbar navbar-dark bg-dark navbar-expand-lg">
    <div class="top-wrapper">
        <a class="logo" href="{{ route('partak.index') }}">
            <img src="{{ asset('img/logos/isc-logo-white-color-horizontal.svg') }}" alt="Logo ISC CTU in Prague" />
        </a>

        <a class="toggle-button btn" data-toggle="collapse" href="#navbarNav" role="button" aria-expanded="false" aria-controls="navbarNav">
            <i class="fas fa-bars fa-lg"></i>
        </a>
    </div>

    <div class="collapse navbar-collapse" id="navbarNav">
        @include('partak.components.nav', ['items' => [
            ['title' => 'Dashboard', 'icon' => 'columns', 'route' => 'partak.index'],
            ['title' => 'Users', 'icon' => 'users', 'route' => 'partak.users', 'acl' => 'users.view', 'items' => [
                ['title' => 'Buddies', 'icon' => 'user-graduate', 'route' => 'partak.users.buddies', 'acl' => 'buddy.view'],
                ['title' => 'Exchange students', 'icon' => 'exchange-alt', 'route' => 'partak.users.exchangeStudents', 'acl' => 'exchangeStudents.view'],
                ['title' => 'Office registration', 'icon' => 'user-plus', 'route' => 'partak.users.registration', 'acl' => 'exchangeStudents.register'],
                ['title' => 'Preregistrations', 'icon' => 'user-tag', 'route' => 'partak.users.preregistrations', 'acl' => 'exchangeStudents.register'],
                ['title' => 'Roles', 'icon' => 'users-cog', 'route' => 'partak.users.roles', 'acl' => 'roles.view'],
                ['title' => 'Parťáks', 'icon' => 'user-astronaut', 'route' => 'partak.users.partaks', 'acl' => 'roles.view'],
                ['title' => 'Quarantined', 'icon' => 'user-lock', 'route' => 'partak.users.quarantined', 'acl' => 'quarantined'],
                ['title' => 'Import students', 'icon' => 'file-import', 'route' => 'partak.users.import.index', 'acl' => 'users.import'],
            ]],
            ['title' => 'Trips', 'icon' => 'hiking', 'route' => 'partak.trips', 'items' => [
                ['title' => 'Active trips', 'icon' => 'list', 'route' => 'partak.trips.upcoming', 'acl' => 'trips.view'],
                ['title' => 'My trips', 'icon' => 'star', 'route' => 'partak.trips.my'],
                ['title' => 'Add trip', 'icon' => 'plus', 'route' => 'partak.trips.create', 'acl' => 'trips.add'],
            ]],
            ['title' => 'Events', 'icon' => 'glass-cheers', 'route' => 'partak.events', 'acl' => 'events.view', 'items' => [
                ['title' => 'Active events', 'icon' => 'list', 'route' => 'partak.events.index'],
                ['title' => 'Add event', 'icon' => 'plus', 'route' => 'partak.events.create', 'acl' => 'events.add'],
                ['title' => 'Add inteGREAT event', 'icon' => 'calendar-plus', 'iconStyle' => 'far', 'route' => 'partak.events.create.integreat', 'acl' => 'events.add'],
                ['title' => 'Add Languages event', 'icon' => 'calendar-plus', 'iconStyle' => 'far', 'route' => 'partak.events.create.languages', 'acl' => 'events.add'],
            ]],
            ['title' => 'Stats', 'icon' => 'chart-pie', 'route' => 'partak.stats', 'acl' => 'stats.view', 'items' => [
                ['title' => 'Dashboard', 'route' => 'partak.stats.index', 'id' => 'stats-dashboard'],
                ['title' => 'Arrivals', 'route' => 'partak.stats.arrivals', 'id' => 'stats-arrivals'],
                ['title' => 'Buddies', 'route' => 'partak.stats.buddies', 'id' => 'stats-buddies'],
                ['title' => 'Students', 'route' => 'partak.stats.students', 'id' => 'stats-students'],
                ['title' => 'History', 'route' => 'partak.stats.history', 'id' => 'stats-history'],
                ['title' => 'Exports', 'route' => 'partak.stats.exports', 'id' => 'stats-exports'],
            ]],
            ['title' => 'Settings', 'icon' => 'cog', 'route' => 'partak.settings', 'acl' => ['settings.openingHours', 'settings.edit'], 'items' => [
                ['title' => 'General', 'route' => 'partak.settings.general', 'acl' => 'settings.edit'],
                ['title' => 'Opening hours', 'route' => 'partak.settings.openingHours'],
                ['title' => 'Contacts', 'route' => 'partak.settings.contacts.index', 'acl' => 'settings.edit'],
                ['title' => 'Coronavirus', 'route' => 'partak.settings.coronavirus', 'acl' => 'settings.edit'],
            ]],
            ['title' => 'Alumni Newsletters', 'icon' => 'newspaper', 'route' => 'alumni.newsletters.index', 'acl' => ['alumniNewsletter.create', 'alumniNewsletter.update', 'alumniNewsletter.delete']],
            ['title' => 'Tools', 'icon' => 'tools', 'route' => 'partak.tools', 'acl' => ['users.import', 'partak.logs'], 'items' => [
                ['title' => 'ESNcard labels generator', 'icon' => 'id-card', 'route' => 'partak.esn-card-labels.index', 'acl' => 'users.import'],
                ['title' => 'Logs', 'icon' => 'file', 'route' => 'partak.logs', 'acl' => 'logs'],
            ]],
            ['spacer' => true],
            ['title' => 'Buddy database', 'icon' => 'user-friends', 'route' => 'buddy-home', 'target' => '_blank'],
            ['title' => 'Wiki', 'icon' => 'question-circle', 'route' => 'wiki', 'target' => '_blank'],
            ['title' => 'NAS', 'icon' => 'photo-video', 'route' => 'nas', 'target' => '_blank'],
        ]])
    </div>
</nav>
