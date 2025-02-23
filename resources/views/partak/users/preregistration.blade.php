@extends('partak.users.layout')

@section('inner-content')
    <div class="container">
        @include('partak.components.student-search',[
            'target' => url('/partak/users/preregistrations/{id_user}')
        ])
    </div>

    <div class="container">
        <preregister url="{{ route('api.preregister') }}" :default-limit="{{ $limit }}"></preregister>
    </div>
@stop
