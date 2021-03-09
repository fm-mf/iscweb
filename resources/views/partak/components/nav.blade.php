<ul class="navbar-nav">
    @foreach($items as $item)
        @isset($item['spacer'])
            <div class="spacer"></div>
        @else
        @include('partak.components.nav-item', [
            'title' => $item['title'],
            'route' => $item['route'],
            'acl' => isset($item['acl']) ? $item['acl'] : null,
            'icon' => isset($item['icon']) ? $item['icon'] : null,
            'iconStyle' => $item['iconStyle'] ?? null,
            'items' => isset($item['items']) ? $item['items'] : null,
            'target' => isset($item['target']) ? $item['target'] : null,
            'id' => isset($item['id']) ? $item['id'] : null,
        ])
        @endisset
    @endforeach
</ul>
