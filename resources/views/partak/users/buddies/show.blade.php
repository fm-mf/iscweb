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
        @include('partak.users.partials.user-info', ['user' => $buddy->user])
    </div>

    @can('acl', 'buddy.verify')
        @if(!$buddy->isVerified() && !$buddy->isDenied())
            <div class="container">
                <div class="row">
                    <div class="col-12 form-group">
                        @include('partak.users.partials._buddy-verification-data')
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 d-flex flex-wrap">
                        @include('partak.users.partials._buddy-approve-deny-buttons', ['classes' => 'form-group mr-2'])
                    </div>
                </div>
            </div>
        @endif
    @endcan

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
                            <td>
                                <div class="d-flex justify-content-end">
                                    @include('partak.users.partials._remove-buddy-button')
                                </div>
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

    @component('components.attended-trips', ['studentName' => $buddy->person->first_name, 'trips' => $attendedTrips])
    @endcomponent

    @component('components.attended-trips', ['trips' => $reservedTrips])
        @slot('title')
            Active trip reservations
        @endslot
        @slot('emptyMessage')
            {{ $buddy->person->first_name }} does not have any active trip reservations.
        @endslot
    @endcomponent
@endsection
