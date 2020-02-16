
<nav class="navbar navbar-expand-lg subnav">
  <div class="container">
    <div style="width: 130px"></div>
    <ul class="navbar-nav">
        @foreach($navItems as $navItem)
            @include('partak.components.nav-item', ['title' => $navItem['title'], 'route' => $navItem['route']])
        @endforeach
    </ul>
  </div>
</nav>