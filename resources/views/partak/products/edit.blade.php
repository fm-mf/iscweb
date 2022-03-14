@extends('partak.layout.subpage')
@section('subpage')
    <div class="container" id="form">
        <div class="col-xl-8">
            <h2>Update merchandise</h2>
            {{ Form::model($product, ['route' => ['partak.products.update', $product], 'method' => 'patch', 'id' => 'form', 'files' => true]) }}

            @include('partak.products.components.form')

            {{ Form::bsSubmit('Save') }}
            {{ Form::close() }}
        </div>
    </div>
@stop
