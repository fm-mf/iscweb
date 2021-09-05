@php
    if (app()->getLocale() === 'en') {
        $flag = 'img/flags/flag-cze.svg';
        $otherLang = 'cs';
    } else {
        $flag = 'img/flags/flag-gbr.svg';
        $otherLang = 'en';
    }
@endphp

<ul class="navbar-nav lang-switcher">
    <li class="nav-item">
        <a class="nav-link btn" href="{{ route($route ?? 'change-language', ['language' => $otherLang]) }}" title="@lang('web.change-language', [], $otherLang)">
            <img src="{{ asset($flag) }}" alt="@lang('web.change-language', [], $otherLang)" />
        </a>
    </li>
</ul>
