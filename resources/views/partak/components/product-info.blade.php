<div class="d-flex">
    <img class="image-preview" src="{{ $product->image_url }}" />
    <div class="ml-4">
        <div class="d-flex">
            <h2>{{ $product->name }}</h2>
            @isset($showActions)
            <div class="ml-4">
                @can('acl', 'products.edit')
                    <a
                        href="{{ route('partak.products.edit', $product) }}"
                        role="button"
                        class="btn btn-success btn-sm"
                    >
                        <i class="fas fa-pen"></i>
                        Edit
                    </a>
                @endcan
            </div>
            @endisset
        </div>
        <p><strong>Price:</strong> {{ $product->price }} CZK</p>
        {!! $product->description !!}
    </div>
</div>
