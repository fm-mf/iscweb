<ul class="navbar-nav ml-auto">
    @foreach($navItems as $navItem)
        @component('web.components.nav-item', [
                'title' => $navItem['title'],
                'route' => $navItem['route'],
                'icon' => $navItem['icon'] ?? null,
                'onClick' => $navItem['onClick'] ?? null,
        ])
        @endcomponent
    @endforeach
</ul>
