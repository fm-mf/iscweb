<div class="form-group">
    <a href="{{ route('auth.provider', ['provider' => 'cvut']) }}" class="btn btn-outline-primary">
        <img
            src="{{ asset('img/logos/cvut/symbol_cvut_plna_samostatna_verze.svg') }}"
            alt="@lang('auth.cvut-symbol')"
            style="height: 1.5rem; margin-top: -0.5rem"
        />
        @if (request()->routeIs('register'))
            @lang('auth.register-with-ctu.btn-title')
        @else
            @lang('auth.log-in-ctu')
        @endif
    </a>
</div>
