@extends('partak.layout.subpage')
@section('subpage')
    <div class="container" id="form">
        <div class="col-xl-8">
            <h2>Create merchandise</h2>
            {{ Form::model($product, ['route' => ['partak.products.store'], 'method' => 'post', 'id' => 'form', 'files' => true]) }}

            @include('partak.products.components.form')

            {{ Form::bsSubmit('Create merchandise') }}
            {{ Form::close() }}
        </div>
    </div>
@stop
