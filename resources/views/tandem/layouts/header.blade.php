<header>
    <nav class="navbar navbar-dark bg-dark navbar-expand-md">
        <div class="container">
            <div class="d-flex flex-grow-1 align-items-center">
                <span class="w-100 d-md-none"></span>
                <a class="navbar-brand" href="{{ route('tandem.index') }}">
                    <img src="{{ asset('img/logos/isc-logo-white-color-horizontal.svg') }}" alt="Logo ISC CTU in Prague" />
                </a>
                <span class="w-100 text-right">
                                <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                            </span>
            </div>
            <div class="collapse navbar-collapse" id="navbarNav">
                @guest
                    @component('web.components.navbar-nav', ['navItems' => [
                        ['title' => $shortName, 'route' => 'web.index'],
                        ['title' => 'Register', 'route' => 'tandem.register', 'icon' => 'fas fa-user-plus'],
                        ['title' => 'Log in', 'route' => 'tandem.login', 'icon' => 'fas fa-sign-in-alt'],
                    ]])
                    @endcomponent
                @else
                    @component('web.components.navbar-nav', ['navItems' => [
                        ['title' => $shortName, 'route' => 'web.index'],
                        ['title' => 'Profile', 'route' => 'tandem.profile', 'icon' => 'fas fa-user-edit'],
                        ['title' => 'Log out', 'route' => 'tandem.logout', 'icon' => 'fas fa-sign-out-alt', 'onClick' => "event.preventDefault(); document.getElementById('logout-form').submit();"],
                    ]])
                    @endcomponent
                    <form id="logout-form" action="{{ route('tandem.logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                @endguest
            </div>
        </div>
    </nav>
</header>
