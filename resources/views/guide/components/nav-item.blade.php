@php
    $activeClass = ($active === $page)
        ? ' class="active"'
        : '';
@endphp

<li>
    <a href="{{ route('guide-page', ['page' => $page]) }}"{!! $activeClass !!}>
        {{ $title }}
    </a>
</li>
