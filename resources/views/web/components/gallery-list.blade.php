<ul class="row list-unstyled gallery-row">
    @foreach($images as $image)
        @component('web.components.gallery-list-item', compact('image'))
        @endcomponent
    @endforeach
</ul>