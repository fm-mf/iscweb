@extends('partak.settings.layout')

@section('inner-content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissable fade in">
            <button class="close" data-dismiss="alert" aria-label="close"><span class="fas fa-times"></span></button>
            <span class="fas fa-check"></span> @lang(session('success')['event'], ['position' => session('success')['position']])
        </div>
    @endif

    <div class="container">
        <div class="text-right">
            <a class="btn btn-success" href="{{ route('partak.settings.contacts.create') }}">
                <i class="fas fa-user-plus"></i> Add new contact
            </a>
        </div>
        <contacts-order></contacts-order>
    </div>
@endsection
