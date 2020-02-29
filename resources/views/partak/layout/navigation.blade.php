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
            ]],
            ['title' => 'Trips', 'icon' => 'image', 'route' => 'partak.trips', 'items' => [
                ['title' => 'Active trips', 'icon' => 'list', 'route' => 'partak.trips.list', 'acl' => 'trips.view'],
                ['title' => 'My trips', 'icon' => 'star', 'route' => 'partak.trips.my'],
                ['title' => 'Add trip', 'icon' => 'plus', 'route' => 'partak.trips.create', 'acl' => 'trips.add'],
            ]],
            ['title' => 'Events', 'icon' => 'glass-cheers', 'route' => 'partak.events', 'acl' => 'events.view', 'items' => [
                ['title' => 'Active events', 'icon' => 'list', 'route' => 'partak.events.list'],
                ['title' => 'Add event', 'icon' => 'plus', 'route' => 'partak.events.create', 'acl' => 'events.add'],
            ]],
            ['title' => 'Stats', 'icon' => 'chart-pie', 'route' => 'partak.stats.index', 'acl' => 'stats.view'],
            ['title' => 'Settings', 'icon' => 'cog', 'route' => 'partak.settings', 'acl' => 'settings.edit', 'items' => [
                ['title' => 'General', 'route' => 'partak.settings', 'acl' => 'settings.edit'],
                ['title' => 'Opening hours', 'route' => 'partak.settings.openingHours', 'acl' => 'settings.edit'],
                ['title' => 'Contacts', 'route' => 'partak.settings.contacts.index', 'acl' => 'settings.edit']
            ]],
            ['title' => 'Alumni Newsletters', 'icon' => 'newspaper', 'route' => 'alumni.newsletters.index', 'acl' => ['alumniNewsletter.create', 'alumniNewsletter.update', 'alumniNewsletter.delete']],
            ['title' => 'Logs', 'icon' => 'file', 'route' => 'partak.logs', 'acl' => 'logs'],
            ['spacer' => true],
            ['title' => 'Wiki <i class="fas fa-external-link-alt ml-1"></i>', 'icon' => 'question-circle', 'route' => 'wiki', 'target' => '_blank'],
            ['title' => 'NAS <i class="fas fa-external-link-alt ml-1"></i>', 'icon' => 'photo-video', 'route' => 'nas', 'target' => '_blank'],
        ]])
    </div>
</nav>
