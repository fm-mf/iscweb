@extends('partak.users.layout')
@section('inner-content')
    <div class="container">
        @include('partak.components.buddy-search')
    </div>

    <div class="container">
        @if(session('success'))
            <div class="success top-message">
                <i class="fas fa-check mr-1"></i> {{ session('success')  }}
            </div>
        @endif

        @can('acl', 'buddy.verify')
            <h3>Not verified Buddies</h3>
            @if($notVerifiedBuddies->count() > 0)
            <div class="table-responsive">
                <table class="table p-table">
                    @foreach($notVerifiedBuddies->get() as $buddy)
                        <tr>
                            <td>@include('partak.components.user-link', ['user' => $buddy->person])</td>
                            <td>{{ $buddy->user()->email }}</td>
                            <td align="right">
                                <protectedbutton url="{{ url('partak/users/buddies/approve/' . $buddy->id_user) }}"
                                                    protection-text="Approve buddy {{ $buddy->person->getFullName() }}?"
                                                    button-style="btn-success btn-xs icon-button"><i class="fas fa-check mr-1"></i> Approve</protectedbutton>
                                <protectedbutton url="{{ url('partak/users/buddies/deny/' . $buddy->id_user) }}"
                                                    protection-text="Deny buddy {{ $buddy->person->getFullName() }}?"
                                                    button-style="btn-danger btn-xs icon-button"><i class="fas fa-times mr-1"></i> Deny</protectedbutton>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            @endif
        @endcan
    </div>

@stop
