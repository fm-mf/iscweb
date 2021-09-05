<li class="nav-item{{ request()->routeIs($route) ? " active" : "" }}">
    <a class="nav-link" href="{{ route($route) }}" @isset($onClick) onclick="{{ $onClick }}" @endisset @isset($target) target="{{ $target }}" @endisset>
        @isset($icon)
            <span class="{{ $icon }}"></span>
        @endisset
        {{ $title }}
    </a>
</li>
