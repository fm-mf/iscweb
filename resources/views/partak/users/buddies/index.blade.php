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
            <h3>Buddies to verify @if($notVerifiedBuddies->isNotEmpty())<span class="badge badge-warning">{{ $notVerifiedBuddies->count() }}</span>@endif</h3>

            @if($notVerifiedBuddies->isEmpty())
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
                    @foreach($notVerifiedBuddies as $buddy)
                        <li class="row py-2">
                            <div class="col-12 col-sm-4">@include('partak.components.user-link', ['user' => $buddy->person])</div>
                            <div class="col-12 col-sm-5">{{ $buddy->user->email }}</div>
                            <div class="col-12 col-sm-3 text-sm-right">
                                <span title="{{ $buddy->registered_on }}">{{ $buddy->registered_ago }}</span>
                            </div>
                            <div class="col-lg">
                                @include('partak.users.partials._buddy-verification-data')
                            </div>
                            <div class="col-lg-auto d-flex justify-content-end flex-wrap">
                                @include('partak.users.partials._buddy-approve-deny-buttons', ['classes' => 'ml-2'])
                            </div>
                        </li>
                    @endforeach
                </ol>
            @endif
        @endcan
    </div>
@endsection
