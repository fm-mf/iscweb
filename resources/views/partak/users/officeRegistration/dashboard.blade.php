@extends('partak.users.layout')
@section('inner-content')
    @include('partak.users.officeRegistration.search')
    @can('acl', 'exchangeStudents.add')
        <div class="row row-inner">
            <div class="col-sm-12 align-center">
                    <a href="{{ url('partak/users/office-registration/create') }}" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-plus up"></span> Add new student</a>
            </div>
        </div>
    @endcan
@stop
