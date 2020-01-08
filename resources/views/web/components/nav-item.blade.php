<li class="nav-item{{ request()->routeIs($route) ? " active" : "" }}">
    <a class="nav-link" href="{{ route($route) }}">{{ $title }}</a>
</li>
