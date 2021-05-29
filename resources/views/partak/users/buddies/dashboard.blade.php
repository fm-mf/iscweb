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
            <h3>Buddies to verify @if($notVerifiedBuddies->count() > 0)<span class="badge badge-warning">{{ $notVerifiedBuddies->count() }}</span>@endif</h3>

            @if($notVerifiedBuddies->count() == 0)
                <div class="text-center">
                    <i class="fas fa-check text-success mr-2"></i> No buddies to verify
                </div>
            @else
                <ol class="table list-unstyled">
                    <li class="row py-2 thead-light">
                        <div class="col-sm-4">Name</div>
                        <div class="col-sm-5">E-mail</div>
                        <div class="col-sm-3 text-sm-right">Registered at</div>
                        <div class="col-lg">Motivation / Verification e-mail</div>
                        <div class="col-lg-auto text-right">Actions</div>
                    </li>
                    @foreach($notVerifiedBuddies->get() as $buddy)
                        <li class="row py-2">
                            <div class="col-12 col-sm-4">@include('partak.components.user-link', ['user' => $buddy->person])</div>
                            <div class="col-12 col-sm-5">{{ $buddy->user()->email }}</div>
                            <div class="col-12 col-sm-3 text-sm-right">
                                <span title="{{ $buddy->registered_on }}">{{ $buddy->registered_ago }}</span>
                            </div>
                            <div class="col-lg">
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
                            <div class="col-lg-auto text-right">
                                <protectedbutton url="{{ url('partak/users/buddies/approve/' . $buddy->id_user) }}"
                                                    protection-text="Approve buddy {{ $buddy->person->getFullName() }}?"
                                                    button-style="btn-success btn-sm icon-button"><i class="fas fa-check mr-1"></i> Approve</protectedbutton>
                                <protectedbutton url="{{ url('partak/users/buddies/deny/' . $buddy->id_user) }}"
                                                    protection-text="Deny buddy {{ $buddy->person->getFullName() }}?"
                                                    button-style="btn-danger btn-sm icon-button"><i class="fas fa-times mr-1"></i> Deny</protectedbutton>
                            </div>
                        </li>
                    @endforeach
                </ol>
            @endif
        @endcan
    </div>

@stop
