<header>
    @component('components.navbar', ['indexRoute' => __('routes.web.index')])
        @component('components.navbar-nav')
            @auth
                @component('components.nav-item', ['title' => __('auth.profile.title'), 'route' => 'auth.profile.edit', 'icon' => 'fas fa-user'])@endcomponent
                @component('components.nav-item', ['title' => __('auth.log-out'), 'route' => 'logout', 'icon' => 'fas fa-sign-out-alt'])@endcomponent
            @endauth
        @endcomponent
        @component('components.navbar-lang-switcher')
        @endcomponent
    @endcomponent
</header>
