@if(session()->has($sessionKey))
    <p class="alert alert-{{ $type }}" role="alert">
        <i class="{{ $iconStyle }} {{ $icon }} fa-fw float-left"></i>
        <span class="d-block ml-4">{{ session($sessionKey) }}</span>
    </p>
@endif
