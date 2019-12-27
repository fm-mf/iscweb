@extends('partak.settings.layout')

@section('inner-content')
    <div class="row row-inner">
        <div class="col-md-11 col-lg-10">
            <div id="alert-success-wrapper">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissable fade in">
                        <button class="close" data-dismiss="alert" aria-label="close"><span class="fas fa-times"></span></button>
                        <span class="fas fa-check"></span> @lang(session('success')['event'], ['position' => session('success')['position']])
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <a class="btn btn-success pull-right" href="{{ route('partak.settings.contacts.create') }}"><span class="fas fa-user-plus"></span> Add new contact</a>
                </div>
            </div>
            <contacts-order></contacts-order>
        </div>
    </div>
@endsection
