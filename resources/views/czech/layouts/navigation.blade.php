<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
    <div class="container">
        <div class="d-flex flex-grow-1 align-items-center">
            <span class="w-100 d-lg-none"></span>
            <a class="navbar-brand" href="{{ route('czech.index') }}">
                <img src="{{ asset('img/logos/esn-ctu-logo-white.svg') }}" alt="Logo ESN CTU in Prague" />
            </a>
            <span class="w-100 text-right">
                <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </span>
        </div>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item{{ request()->routeIs("czech.about") ? " active" : "" }}">
                    <a class="nav-link" href="{{ route('czech.about') }}">O nás</a>
                </li>
                <li class="nav-item{{ request()->routeIs("czech.activities.index") ? " active" : "" }}">
                    <a class="nav-link" href="{{ route('czech.activities.index') }}">Co děláme</a>
                </li>
                <li class="nav-item{{ request()->routeIs("czech.buddy-program") ? " active" : "" }}">
                    <a class="nav-link" href="{{ route('czech.buddy-program') }}">O Buddy programu</a>
                </li>
                <li class="nav-item{{ request()->routeIs("czech.calendar") ? " active" : "" }}">
                    <a class="nav-link" href="{{ route('czech.calendar') }}">Kalendář</a>
                </li>
                <li class="nav-item{{ request()->routeIs("czech.faq") ? " active" : "" }}">
                    <a class="nav-link" href="{{ route('czech.faq') }}">FAQ</a>
                </li>
                <li class="nav-item{{ request()->routeIs("czech.contacts") ? " active" : "" }}">
                    <a class="nav-link" href="{{ route('czech.contacts') }}">Kontakty</a>
                </li>
                <li class="nav-item d-lg-none mb-1">
                    <a class="nav-link btn btn-outline-light" href="{{ route('buddy-handbook-cs') }}" target="_blank">
                        <span class="fas fa-file-pdf"></span>Buddy příručka
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-primary" href="{{ route('buddy-home') }}">
                        <span class="fas fa-sign-in-alt"></span>Buddy program
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav lang-switcher">
                <li class="nav-item">
                    <a class="nav-link btn" href="{{ route('web.index') }}">
                        <img src="{{ asset('img/flags/flag-gbr.svg') }}" alt="Switch to English page" />
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
