@if($products->isEmpty())
    <p class="alert alert-light">
        {{ $slot }}
    </p>
@else
    <div class="table-responsive">
        <table class="table p-table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                @component('partak.products.components.list-item', compact('product'))
                @endcomponent
            @endforeach
            </tbody>
        </table>
    </div>

    {{ $products->links() }}
@endif
