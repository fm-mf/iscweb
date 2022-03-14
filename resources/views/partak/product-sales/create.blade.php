@extends('partak.layout.subpage')
@section('subpage')
    <div class="container" id="form">
        <div class="col-xl-8">
            <h1>New product sale – {{ $product->name }}</h1>
            @component('partak.components.product-info', ['product' => $product])
            @endcomponent

            {{ Form::model(null, ['route' => ['partak.products.sales.store', $product], 'method' => 'post', 'id' => 'form', 'files' => true]) }}

            <h2>User details:</h2>
            @isset($user)
                @include("partak.users.partials.user-info", ['user' => $user, 'noTitle' => true])
                {{ Form::hidden('id_user', $user->id_user) }}
            @else
                {{ Form::bsText('customer_name', 'Name', 'required') }}
                {{ Form::bsEmail('customer_email', 'E-mail', 'required') }}
            @endisset

            {{ Form::bsNumber('paid', 'Paid', 'required', $product->price, ['min' => 0]) }}

            {{ Form::bsSubmit('Sale') }}
            {{ Form::close() }}
        </div>
    </div>
@stop
