<header>
    <nav class="navbar navbar-dark bg-dark navbar-expand-md">
        <div class="container">
            <div class="d-flex flex-grow-1 align-items-center">
                <span class="w-100 d-md-none"></span>
                <a class="navbar-brand" href="{{ route('tandem.index') }}">
                    <img src="{{ asset('img/logos/isc-logo-white-color-horizontal.svg') }}" alt="Logo {{ $shortName }}" />
                </a>
                <span class="w-100 text-right">
                    <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </span>
            </div>
            <div class="collapse navbar-collapse" id="navbarNav">
                @guest('tandem')
                    @component('web.components.navbar-nav', ['navItems' => [
                        ['title' => $shortName, 'route' => 'web.index'],
                        ['title' => __('tandem.auth.register'), 'route' => 'tandem.register', 'icon' => 'fas fa-user-plus'],
                        ['title' => __('tandem.auth.log-in'), 'route' => 'tandem.login', 'icon' => 'fas fa-sign-in-alt'],
                    ]])
                    @endcomponent
                @else
                    @component('web.components.navbar-nav', ['navItems' => [
                        ['title' => $shortName, 'route' => 'web.index'],
                        ['title' => __('tandem.my-profile.title'), 'route' => 'tandem.my-profile', 'icon' => 'fas fa-user-edit'],
                        ['title' => __('tandem.auth.log-out'), 'route' => 'tandem.logout', 'icon' => 'fas fa-sign-out-alt', 'onClick' => "event.preventDefault(); document.getElementById('logout-form').submit();"],
                    ]])
                    @endcomponent
                    <form id="logout-form" action="{{ route('tandem.logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                @endguest
                <ul class="navbar-nav lang-switcher">
                    <li class="nav-item">
                        <a class="nav-link btn" href="{{ route('tandem.change-language', ['language' => app()->getLocale() === 'en' ? 'cs' : 'en']) }}">
                            @if(app()->getLocale() === 'en')
                                <img src="{{ asset('img/flags/flag-cze.svg') }}" alt="@lang('tandem.change-language', [], 'cs')" />
                            @else
                                <img src="{{ asset('img/flags/flag-gbr.svg') }}" alt="@lang('tandem.change-language', [], 'en')" />
                            @endif
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
