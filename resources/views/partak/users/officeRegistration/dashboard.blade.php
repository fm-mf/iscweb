@extends('partak.users.layout')
@section('inner-content')
    <div class="container">
        @include("partak.components.student-search", [
            'target' => '/partak/users/office-registration/registration/{id_user}'
        ])
    </div>

    <div class="container">
        @can('acl', 'exchangeStudents.add')
            <div class="row row-inner">
                <div class="col-sm-12 text-center">
                        <a href="{{ url('partak/users/office-registration/create') }}" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-plus up"></span> Add new student</a>
                </div>
                <div class="col-sm-12 text-center">
                    <b>Already registered {{ $esnRegistered }}</b>
                </div>
            </div>
        @endcan
    </div>
@stop
