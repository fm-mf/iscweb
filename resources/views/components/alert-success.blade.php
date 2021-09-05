@component('components.alert', [
    'type' => 'success',
    'sessionKey' => $sessionKey,
    'iconStyle' => $iconStyle ?? 'fas',
    'icon' => $icon ?? 'fa-check',
])
@endcomponent
