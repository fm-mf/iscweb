<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
    <div class="container">
        <div class="d-flex flex-grow-1 align-items-center">
            <span class="w-100 d-lg-none"></span>
            <a class="navbar-brand" href="{{ route($indexRoute ?? 'web.index') }}">
                <img src="{{ asset('img/logos/isc-logo-white-color-horizontal.svg') }}" alt="Logo ISC CTU in Prague" />
            </a>
            <span class="w-100 text-right">
                <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </span>
        </div>
        <div class="collapse navbar-collapse" id="navbarNav">
            {{ $slot }}
        </div>
    </div>
</nav>
