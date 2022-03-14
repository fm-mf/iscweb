<tr>
    <td>
        <a href="{{ route('partak.products.show', $product) }}">
            {{ $product->name }}
        </a>
    </td>
    <td>{{ $product->price }} CZK</td>
    <td>
        <div class="d-flex justify-content-end">
            @can('acl', 'products.edit')
                <a href="{{ route('partak.products.edit', $product) }}" class="btn btn-success btn-sm">
                    <span class="fas fa-pen"></span> Edit
                </a>
            @endcan
            @can('acl', 'products.remove')
                {{ Form::open(['route' => ['partak.products.destroy', $product], 'method' => 'DELETE', 'class' => 'd-inline-block ml-1']) }}
                <protected-submit-button
                    protection-title="Delete product?"
                    protection-text="Do you really want to delete &quot;{{ $product->name }}&quot;?"
                    proceed-text="Delete"
                    classes="btn-danger btn-sm"
                    proceed-classes="btn-danger"
                    modal-id="delete-product-{{ $product->id_event }}"
                    :form-group="false"
                >
                    <span class="fas fa-trash"></span> Delete
                </protected-submit-button>
                {{ Form::close() }}
            @endcan
        </div>
    </td>
</tr>
