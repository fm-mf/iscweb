@extends('partak.users.layout')

@section('inner-content')
    <div class="container table-responsive">
        <div class="d-flex align-items-center">
            <h3>Quarantined students</h3>
            <div class="ml-auto d-flex align-items-center">
                <div><span class="badge badge-info">{{ $users->count() }}</span> students quarantined</div>
                <a class="btn btn-primary btn-sm ml-2" target="_blank" href="{{ route('partak.users.quarantined.export') }}"><i class="fas fa-file-excel"></i> Export</a>
            </div>
        </div>

        <table class="table p-table">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Email</th>
                    <th>Quarantined until</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $exStudent)
                <tr>
                    <td>@include('partak.components.user-link', ['user' => $exStudent->person])</td>
                    <td>{{ $exStudent->user->email }}</td>
                    <td>{{ $exStudent->quarantined_until->formatLocalized(__('formatting.full-date')) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop
