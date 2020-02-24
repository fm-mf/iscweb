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
        <div class="d-flex align-items-center mb-2">
            <h2 class="mb-0">{{ $buddy->person->first_name }} <span class="last-name">{{ $buddy->person->last_name }}</span></h2>
            @if($buddy->person->buddy)<span class="badge badge-info ml-2">Buddy</span>@endif
            @if($buddy->person->exchangeStudent)<span class="badge badge-success ml-2">Exchange student</span>@endif
            @can('acl', 'buddy.edit')
                <a
                    href="{{ url('partak/users/buddies/edit/' . $buddy->id_user) }}"
                    class="btn btn-xs btn-success ml-4"
                >
                    <i class="fas fa-pen"></i> Edit
                </a>
            @endcan
        </div>

        <div class="row container mb-0">
            <div class="col-2-sm">
                <img class="img-circle" width="125" src="{{ asset($buddy->person->avatar()) }}">
            </div>
            <div class="col-10-sm pl-4">
                <div class="info-line">
                    <i class="fas fa-envelope fa-fw mr-1"></i> {{ $buddy->person->user->email }}
                </div>
                <div class="info-line">
                    <i class="fas fa-phone fa-fw mr-1"></i> @if(isset($buddy->phone)) {{ $buddy->phone }} @else No Phone @endif
                </div>
                @if($buddy->country)
                <div class="info-line">
                    <i class="fas fa-globe fa-fw mr-1"></i> {{ $buddy->country->full_name }}
                </div>
                @endif
                <div class="info-line">
                    @if($buddy->verified == 'y')
                        <i class="fas fa-check fa-fw mr-1"></i> Verified
                    @elseif ($buddy->verified == 'n')
                        <i class="fas fa-hourglass-half fa-fw mr-1"></i> Not verified yet
                    @else
                        <i class="fas fa-times fa-fw mr-1"></i> Denied
                    @endif
                </div>
            </div>
        </div>
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