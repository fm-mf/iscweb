<ul class="navbar-nav ml-auto">
    @foreach($navItems as $navItem)
        @component('web.components.nav-item', ['title' => $navItem['title'], 'route' => $navItem['route']])
        @endcomponent
    @endforeach
</ul>
