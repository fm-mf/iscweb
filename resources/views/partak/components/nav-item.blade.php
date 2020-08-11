@if ((!isset($acl) || $acl === null) || (
        is_array($acl) &&
        collect($acl)->first(function ($item) use($acl) {
            return Gate::check('acl', $acl);
        })) || (
        !is_array($acl) &&
        Gate::check('acl', $acl)
    )
)
<?php $active = strpos(request()->route()->getName(), $route) === 0; ?>
<?php $navId = str_replace('.', '-', $route) ?>

<li class="nav-item{{ $active ? " active" : "" }}">
    @if (!$items)<a class="nav-link d-flex align-items-center"@if ($target) target="{{ $target }}"@endif @if ($id) id="{{ $id }}"@endif href="{{ route($route) }}">@endif
    @if ($items)<a class="nav-link d-flex align-items-center" href="#{{ $navId }}" role="button" data-toggle="collapse" aria-expanded="{{ $active ? 'true' : 'false' }}" aria-controls="{{ $navId }}">@endif
        <i class="fas @if($icon)fa-{{ $icon }}@endif fa-fw"></i> {{ $title }}@if($target === '_blank') <i class="fas fa-external-link-alt fa-xs ml-2"></i>@endif
    </a>

    @if ($items)
        <div class="collapse{{ $active ? ' show' : ''}}" id="{{ $navId }}">
            @include("partak.components.nav", ['item' => $items])
        </div>
    @endif
</li>
@endif