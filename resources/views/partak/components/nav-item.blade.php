@if ((!isset($acl) || $acl === null) || (
        is_array($acl) &&
        collect($acl)->first(function ($item) {
            return Gate::check('acl', $item);
        })) || (
        !is_array($acl) &&
        Gate::check('acl', $acl)
    )
)

@php
    $active = empty($items) ? request()->routeIs($activeRoute) : request()->routeIs("{$activeRoute}*");
    $navId = str_replace('.', '-', $route)
@endphp

<li class="nav-item{{ $active ? " active" : "" }}" >
    <a class="nav-link d-flex align-items-center"
        @if (!$items)
            @if ($target) target="{{ $target }}" @endif
            @if ($id) id="{{ $id }}" @endif
            href="{{ route($route) }}"
        @else
            href="#{{ $navId }}"
            role="button"
            data-toggle="collapse"
            aria-expanded="{{ $active ? 'true' : 'false' }}"
            aria-controls="{{ $navId }}"
        @endif
    >
        <i class="@isset($iconStyle){{ $iconStyle }}@else fas @endisset @if($icon)fa-{{ $icon }}@endif fa-fw"></i>
        {{ $title }}@if($target === '_blank') <i class="fas fa-external-link-alt fa-xs ml-2"></i>@endif
    </a>

    @if ($items)
        <div class="collapse{{ $active ? ' show' : ''}}" id="{{ $navId }}">
            @include("partak.components.nav", ['item' => $items])
        </div>
    @endif
</li>
@endif
