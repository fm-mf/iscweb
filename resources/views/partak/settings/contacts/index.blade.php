@extends('partak.settings.layout')

@section('inner-content')
    @if(session('success'))
        <div class="container">
            <div class="alert alert-success alert-dismissable fade show">
                <button class="close" data-dismiss="alert" aria-label="close"><i class="fas fa-times"></i></button>
                <i class="fas fa-check"></i> @lang(session('success')['event'], ['position' => session('success')['position']])
            </div>
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
