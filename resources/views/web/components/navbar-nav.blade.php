<ul class="navbar-nav ml-auto">
    @foreach($navItems as $navItem)
        @isset($navItem)
            @component('web.components.nav-item', [
                'title' => $navItem['title'],
                'route' => $navItem['route'],
                'icon' => $navItem['icon'] ?? null,
                'onClick' => $navItem['onClick'] ?? null,
                'target' => $navItem['target'] ?? null,
            ])
            @endcomponent
        @endisset
    @endforeach
    {{ $slot }}
</ul>
