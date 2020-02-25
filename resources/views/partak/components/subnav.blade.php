
<nav class="navbar navbar-expand-lg subnav">
  <div class="container mb-0">
    <ul class="navbar-nav">
        @foreach($navItems as $navItem)
            @include('partak.components.nav-item', ['title' => $navItem['title'], 'route' => $navItem['route']])
        @endforeach
    </ul>
  </div>
</nav>