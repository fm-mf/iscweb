@extends('partak.layout.subpage')

@section('subpage')
   <div class="container">
        <div class="d-flex">
            <h2>Merchandise</h2>
            @can('acl', 'products.add')
            <div class="ml-4">
                <a href="{{ route('partak.products.create') }}" class="btn btn-success btn-sm">
                    <span class="fas fa-plus"></span> Create new merchandise
                </a>
            </div>
            @endcan
        </div>

        @if(session('success'))
        <div class="success top-message">
            <i class="fas fa-check mr-1"></i> {{ session('success') }}
        </div>
        @endif

        @component('partak.products.components.list', ['products' => $products])
            There is no merchandise :(
        @endcomponent
    </div>
@stop
