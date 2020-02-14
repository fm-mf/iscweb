<nav class="navbar navbar-expand-lg subnav">
  <ul class="navbar-nav">
      @foreach($navItems as $navItem)
          @include('partak.components.nav-item', ['title' => $navItem['title'], 'route' => $navItem['route']])
      @endforeach
  </ul>
</nav>