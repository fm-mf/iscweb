<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
    <div class="container">
        <div class="d-flex flex-grow-1 align-items-center">
            <span class="w-100 d-lg-none"></span>
            <a class="navbar-brand" href="{{ route('web.index') }}">
                <img src="{{ asset('img/logos/esn-ctu-logo-white.svg') }}" alt="Logo ESN CTU in Prague" />
            </a>
            <span class="w-100 text-right">
                <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </span>
        </div>
        <div class="collapse navbar-collapse" id="navbarNav">
            @component('web.components.navbar-nav', ['navItems' => [
                ['title' => 'About us', 'route' => 'web.about'],
                ['title' => 'Survival guide', 'route' => 'guide'],
                ['title' => 'Buddy program', 'route' => 'web.buddy-program'],
                ['title' => 'Activities', 'route' => 'web.activities.index'],
                ['title' => 'Calendar', 'route' => 'web.calendar'],
                ['title' => 'FAQ', 'route' => 'web.faq'],
                ['title' => 'Contacts', 'route' => 'web.contacts'],
            ]])
            @endcomponent
            <ul class="navbar-nav lang-switcher">
                <li class="nav-item">
                    <a class="nav-link btn" href="{{ route('czech.index') }}">
                        <img src="{{ asset('img/flags/flag-cze.svg') }}" alt="Switch to Czech page" />
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
