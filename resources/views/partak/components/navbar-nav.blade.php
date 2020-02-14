<ul class="navbar-nav">
    @foreach($navItems as $navItem)
        @include('partak.components.nav-item', [
            'title' => $navItem['title'],
            'route' => $navItem['route'],
            'acl' => isset($navItem['acl']) ? $navItem['acl'] : null
        ])
    @endforeach
</ul>
