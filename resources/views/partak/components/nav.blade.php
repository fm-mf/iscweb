<ul class="navbar-nav">
    @foreach($items as $item)
        @include('partak.components.nav-item', [
            'title' => $item['title'],
            'route' => $item['route'],
            'acl' => isset($item['acl']) ? $item['acl'] : null,
            'icon' => isset($item['icon']) ? $item['icon'] : null,
            'items' => isset($item['items']) ? $item['items'] : null
        ])
    @endforeach
</ul>
