@extends('partak.users.layout')
@section('inner-content')
    @if (session('removeSuccess'))
        <div class="container">
            <div class="alert alert-success">
                <i class="fas fa-check mr-1"></i> {{ session('removeSuccess') }}
            </div>
        </div>
    @endif

    <div class="container">
        @include('partak.users.partials.user-info', ['user' => $buddy->user()])
    </div>

    @if(isset($myStudents))
        <div class="container">
            <h3>{{ $buddy->person->first_name }}'s exchange students for {{ $currentSemester }}</h3>
            
            <div class="table-responsive">
                <table class="table p-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($myStudents->count() > 0)
                    @foreach($myStudents as $exStudent)
                        <tr>
                            <td>
                                @include("partak.components.user-link", ['user' => $exStudent->person])
                            </td>
                            <td>{{ $exStudent->person->user->email }}</td>
                            <td class="text-right">
                                <a
                                    href="{{ url('partak/users/buddies/'. $buddy->id_user .'/remove/' .$exStudent->id_user) }}"
                                    role="button"
                                    class="btn btn-danger btn-sm"
                                >
                                    <i class="fas fa-times"></i> Remove
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    @else
                        <tr><td colspan="99" class="empty-data">No students</td></tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@stop