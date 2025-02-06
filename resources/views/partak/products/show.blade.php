@extends('partak.layout.subpage')

@section('subpage')
   <div class="container">
       @component('partak.components.product-info', ['product' => $product, 'showActions' => true])
       @endcomponent

        @if($product->isSoldOut)
            <p><strong>This product is no longer available for sale.</strong></p>
        @else
            <div class="container my-3">
                <div class="row">
                    <div class="form-group col-md-9 col-lg-8 col-xl-6 mx-auto">
                        @include('partak.components.student-search',[
                            'label' => 'Sell to Exchange student',
                            'target' => route('partak.products.sales.create', $product) . '?id_user={id_user}',
                            'create' => false
                        ])
                    </div>
                    <div class="form-group col-md-9 col-lg-8 col-xl-6 mx-auto">
                        @include('partak.components.buddy-search',[
                            'label' => 'Sell to Buddy',
                            'target' => route('partak.products.sales.create', $product) . '?id_user={id_user}'
                        ])
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 text-center form-group">
                        <a
                            href="{{ route('partak.products.sales.create', $product) }}"
                            role="button"
                            class="btn btn-primary"
                        >
                            <i class="fas fa-cart-plus"></i>
                            Sell to un-registered person
                        </a>
                    </div>
                </div>
            </div>
        @endif

        <div class="container">
            <h2>Sales</h2>

            @if ($sales->count() > 0)
            <div class="table-responsive">
                <table class="table p-table table-sm">
                    <thead>
                        <tr>
                            <th>Buyer name</th>
                            <th>Buyer e-mail</th>
                            <th class="text-right">Amount paid</th>
                            <th></th>
                            <th>Sale date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales as $sale)
                        <tr>
                            @if ($sale->user)
                            <td>@include('partak.components.user-link', ['user' => $sale->user->person])</td>
                            <td>{{ $sale->user->person->email }}</td>
                            @else
                            <td>{{ $sale->customer_name }}</td>
                            <td>{{ $sale->customer_email }}</td>
                            @endif
                            <td class="text-right pr-1">{{ $sale->receipt->amount }} CZK</td>
                            <td class="pl-1">@isset($sale->receipt->payment_method)<i class="{{ $sale->receipt->payment_method->icon() }} fa-fw" title="{{ $sale->receipt->payment_method->name }}"></i>@endisset</td>
                            <td>{{ $sale->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
                <div class="my-2">No sales yet</div>
            @endif

            {{ $sales->links() }}
        </div>
    </div>
@stop
