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

    @can('acl', 'buddy.verify')
        @if($buddy->verified === 'n')
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        @if($buddy->motivation)
                            <p class="mb-0"><strong>Motivation:</strong> {{ $buddy->motivation }}</p>
                        @elseif(hash_equals($buddy->user()->email ?? "", $buddy->verification_email ?? ""))
                            <p class="mb-0">{{ $buddy->person->first_name }} has used university e-mail for registration</p>
                        @elseif($buddy->verification_email)
                            <p class="mb-0">{{ $buddy->person->first_name }} has entered university e-mail for verification: {{ $buddy->verification_email }}</p>
                        @else
                            <p class="mb-0">{{ $buddy->person->first_name }} has not yet filled either a university e-mail or motivation</p>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <protectedbutton url="{{ url('partak/users/buddies/approve/' . $buddy->id_user) }}"
                                         protection-text="Approve buddy {{ $buddy->person->getFullName() }}?"
                                         button-style="btn-success btn-sm icon-button"><i class="fas fa-check mr-1"></i> Approve</protectedbutton>
                        <protectedbutton url="{{ url('partak/users/buddies/deny/' . $buddy->id_user) }}"
                                         protection-text="Deny buddy {{ $buddy->person->getFullName() }}?"
                                         button-style="btn-danger btn-sm icon-button"><i class="fas fa-times mr-1"></i> Deny</protectedbutton>
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
