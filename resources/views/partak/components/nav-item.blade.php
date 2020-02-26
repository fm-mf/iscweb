@if ((!isset($acl) || $acl === null) || (
        is_array($acl) &&
        collect($acl)->first(function ($item) use($acl) {
            return Gate::check('acl', $acl);
        })) || (
        !is_array($acl) &&
        Gate::check('acl', $acl)
    )
)
<li class="nav-item{{ strpos(request()->route()->getName(), $route) === 0 ? " active" : "" }}">
    <a class="nav-link" href="{{ route($route) }}"><i class="fas @if($icon)fa-{{ $icon }}@endif fa-fw"></i> {{ $title }}</a>

    @if ($items)
        @include("partak.components.nav", ['item' => $items])
    @endif
</li>
@endif