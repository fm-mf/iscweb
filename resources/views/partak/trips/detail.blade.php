@extends('partak.trips.layout')
@section('inner-content')
    <div class="container">
        @if( session('successUpdate'))
            <div class="success mb-5">
                <i class="fas fa-check mr-1"></i>{{ session('successUpdate') }}<br>
            </div>
        @elseif(session('error'))
            <div class="alert-danger mb-5">
                <i class="fas fa-exclamation-triangle mr-1"></i>{{ session('error') }}<br>
            </div>
        @endif

        <div class="d-flex">
            <h2 class="trip-header">{{ $trip->event->name }}</h2>
            <div class="ml-4">
                @can('edit', $trip)
                    <a
                        href="{{ url('/partak/trips/edit/' . $trip->id_trip) }}"
                        role="button"
                        class="btn btn-success"
                    >
                        <i class="fas fa-pen"></i>
                        Edit
                    </a>
                @endcan

                <share-button url="{{ $trip->event->reservation_url }}" button-style="btn btn-primary">
                    <i class="fas fa-share-alt"></i>
                    Share
                </share-button>
            </div>
        </div>

        <div class="trip-info">
            <div class="row">
                <div class="col-lg-1 col-md-2 label">Duration</div>
                <div class="col-lg-11 col-md-10">{!! $trip->eventDateInterval() !!}</div>
            </div>
            <div class="row">
                <div class="col-lg-1 col-md-2 label">Capacity</div>
                <div class="col-lg-11 col-md-10">
                    @if ($trip->isFull())
                        <b>Event is full</b>
                    @endif
                    {{ $trip->howIsFill() }} / {{ $trip->capacity }}
                    <span class="ml-3">
                        @if ($trip->type === 'ex+buddy')
                            <?php
                            $buddyCount = $trip->buddyParticipants()->count();
                            $exCount = $particip->count() - $buddyCount;
                            ?>
                            <span class="badge badge-pill badge-info">{{ $exCount }} exchange students</span>
                            <span class="badge badge-pill badge-info">{{ $buddyCount }} buddies</span>
                        @endif
                        @if ($trip->event->reservations_enabled)
                            <span class="badge badge-pill badge-secondary">{{ $reservations->count() }} reservations</span>
                        @endif
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-1 col-md-2 label">Price</div>
                <div class="col-lg-11 col-md-10">{{ $trip->price }} Kč</div>
            </div>
            <div class="row">
                <div class="col-lg-1 col-md-2 label">Organizers</div>
                <div class="col-lg-11 col-md-10">
                    @if($organizers->count() > 0)
                        @foreach($organizers as $organizer)
                            @include("partak.components.user-link", ['user' => $organizer->person])@if(!$loop->last), @endif
                        @endforeach
                    @else Event doesn't have organizers
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if($trip->isOpen() && !$trip->isFull())
        @can('addParticipant', $trip)
            <div class="container">
                <div class="row">
                @if($trip->type === 'exchange' || $trip->type === 'ex+buddy')
                <div class="col-md-6">
                    @include('partak.users.officeRegistration.search',[
                        'label' => 'Add Exchange student',
                        'target' => url('/partak/trips/detail/'. $trip->id_trip .'/add/{id_user}'),
                    ])
                </div>
                @endif
                @if($trip->type === 'buddy' || $trip->type === 'ex+buddy')
                <div class="col-md-6">
                    <h3>Add Buddy</h3>
                    <autocomplete url="{{ url('api/autocomplete/buddies') }}"
                        :fields="[
                            {title: 'All', columns: ['person.first_name', 'person.last_name', 'person.user.email']},
                            {title: 'Name', columns: ['person.first_name', 'person.last_name']},
                            {title: 'Email', columns: ['person.user.email']},
                        ]"
                        :topline="['person.first_name', 'person.last_name']"
                        :subline="['person.user.email']"
                        placeholder="Search Buddy..."
                        target="{{ '/partak/trips/detail/'. $trip->id_trip .'/add/{id_user}' }}"
                        :image="{url: '/avatars/', file: 'person.user.avatar'}">
                    </autocomplete>
                </div>
                @endif
                </div>
            </div>
        @endcan
    @endif

    <div class="container">
        <ul class="nav nav-tabs" role="tablist">
            @if ($trip->event->reservations_enabled)
            <li class="nav-item">
                <a
                    class="nav-link active"
                    id="reservations-tab"
                    data-toggle="tab"
                    href="#reservations"
                    role="tab"
                    aria-controls="reservations"
                    aria-selected="true"
                >
                    Reservations
                    <span class="badge badge-pill badge-info">{{ $reservations->count() }}</span>
                </a>
            </li>
            @endif
            <li class="nav-item">
                <a
                    class="nav-link{{ !$trip->event->reservations_enabled ? " active" : "" }}"
                    id="participants-tab"
                    data-toggle="tab"
                    href="#participants"
                    role="tab"
                    aria-controls="participants"
                    aria-selected="{{ !$trip->event->reservations_enabled ? "true" : "false" }}"
                >
                    Participants
                    <span class="badge badge-pill badge-info">{{ $particip->count() }}</span>
                </a>
            </li>
            <div class="ml-auto">
                <div class="dropdown">
                    <button
                        class="btn btn-primary dropdown-toggle"
                        type="button"
                        id="exportDropdownButton"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        <i class="fas fa-download"></i>
                        Export
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="exportDropdownButton">
                        <a href="{{ url('/partak/trips/detail/'. $trip->id_trip . '/pdf' ) }}" class="dropdown-item">
                            <i class="fas fa-file-pdf"></i> Export participants (PDF)
                        </a>
                        <a href="{{ url('/partak/trips/detail/'. $trip->id_trip . '/excel' ) }}" class="dropdown-item">
                            <i class="fas fa-file-excel"></i> Export participants (Excel)
                        </a>
                    </div>
                </div>
                
            </div>
        </ul>

        <div class="tab-content">
            @if ($trip->event->reservations_enabled)
                <div class="tab-pane active show" id="reservations" role="tabpanel" aria-labelledby="reservations-tab">
                    @if($reservations->count() > 0)
                    <div class="table-responsive">
                    <table class="table p-table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Sex</th>
                            <th>Phone</th>
                            <th>ESN card number</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($reservations as $item)
                            <tr>
                                <td>
                                @if((isset($item->buddy) && Auth::user()->can('acl', 'buddy.view')) ||
                                            (isset($item->exchangeStudent) && Auth::user()->can('acl', 'exchangeStudents.view')))
                                        <a href="{{ ($item->exchangeStudent ?? $item->buddy)->getDetailLink() }}">
                                        {{ $item->getFullName(true) }}
                                    </a>
                                @else
                                    {{ $item->getFullName(true) }}
                                @endif
                                </td>
                                <td>{{ $item->user->email }}</td>
                                <td>{{ $item->getSex() }}</td>
                                <td>{{ $item->exchangeStudent->phone ?? $participant->buddy->phone ?? '-' }}</td>
                                <td>{{ $item->exchangeStudent->esn_card_number ?? '-' }}</td>
                                <td class="text-right">
                                    @can('addParticipant', $trip)
                                        <a href="{{ '/partak/trips/detail/'. $trip->id_trip .'/add/' . $item->user->id_user }}" role="button" class="btn btn-primary btn-sm">Register</a>
                                    @endcan
                                    @can('removeParticipant', $trip)
                                        <protectedbutton
                                            url="{{ '/partak/trips/'. $trip->id_trip .'/cancel/' . $item->user->id_user }}"
                                            protection-text="Remove {{ $item->getFullName() }} from event {{ $trip->event->name }}?"
                                            button-style="btn btn-danger btn-sm"
                                        >
                                            Remove
                                        </protectedbutton>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                    @else
                        No reservations
                    @endif
                </div>
            @endif
            
            <div class="tab-pane{{ !$trip->event->reservations_enabled ? " show active" : "" }}" id="participants" role="tabpanel" aria-labelledby="participants-tab">
                @if($particip->count() > 0)    
                    <div class="panel panel-default">
                        <div class="table-responsive">
                        <table class="table p-table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Sex</th>
                                <th>Phone</th>
                                <th>ESN card number</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($particip as $participant)
                                <tr>
                                    <td>
                                    @if((isset($participant->buddy) && Auth::user()->can('acl', 'buddy.view')) ||
                                            (isset($participant->exchangeStudent) && Auth::user()->can('acl', 'exchangeStudents.view')))
                                        <a href="{{ ($participant->exchangeStudent ?? $participant->buddy)->getDetailLink() }}" target="_blank">{{ $participant->getFullName(true) }}</a>
                                    @else
                                        {{ $participant->getFullName(true)}}
                                    @endif
                                    </td>
                                    <td>{{ $participant->user->email }}</td>
                                    <td>{{ $participant->getSex() }}</td>
                                    <td>{{ $participant->exchangeStudent->phone ?? $participant->buddy->phone ?? '-' }}</td>
                                    <td>{{ $participant->exchangeStudent->esn_card_number ?? '-' }}</td>
                                    <td class="text-right">
                                        @can('viewPayment', $trip)
                                            <a href="{{ url('partak/trips/'. $trip->id_trip .'/payment/' .$participant->pivot->id) }}" role="button" class="btn btn-info btn-sm">Payment</a>
                                        @endcan
                                        @if($trip->isOpen())
                                            @can('removeParticipant', $trip)
                                            <protectedbutton url="{{ url('partak/trips/'. $trip->id_trip .'/remove/' . $participant->id_user) }}"
                                                                protection-text="Remove {{ $participant->getFullName() }} from event {{ $trip->event->name }}?"
                                                                button-style="btn btn-danger btn-sm">Remove</protectedbutton>
                                            @endcan
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                @else Event doesn't have participants
                @endif
            </div>
        </div>
    </div>
@stop

