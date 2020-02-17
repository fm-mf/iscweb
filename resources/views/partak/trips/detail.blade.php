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
            </div>
        </div>

        <table class="table trip-info">
            <tr>
                <th>Duration</th>
                <td>{{ $trip->eventDateInterval() }}</td>
            </tr>
            <tr>
                <th>Capacity</th>
                <td>{!! $trip->howIsFillWithDetail() !!}</td>
            </tr>
            <tr>
                <th>Price</th>
                <td>{{ $trip->price }} Kč</td>
            </tr>
            <tr>
                <th>Organizers</th>
                <td>
                    @if($organizers->count() > 0)
                        @foreach($organizers as $organizer)
                            @include("partak.components.user-link", ['user' => $organizer->person])@if(!$loop->last), @endif
                        @endforeach
                    @else Event doesn't have organizers
                    @endif
                </td>
            <tr>
                <th>Link</th>
                <td colspan="3">
                    <unique-url style="width: 100%" url="{{ $trip->event->reservation_url }}"></unique-url>
                    @if ($trip->event->reservations_enabled)
                        <strong>Can be used for online reservations</strong>
                    @endif
                </td>
            </tr>
            <tr>
            </tr>
        </table>
    </div>

    @if($trip->isOpen() && !$trip->isFull())
        @can('addParticipant', $trip)
            @if($trip->type === 'exchange' || $trip->type === 'ex+buddy')
            @include('partak.users.officeRegistration.search',[
                'label' => 'Add Exchange student',
                'target' => url('/partak/trips/detail/'. $trip->id_trip .'/add/{id_user}'),
            ])
            @endif
            @if($trip->type === 'buddy' || $trip->type === 'ex+buddy')
                <div class="container">
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
        @endcan
    @endif

    @if ($trip->event->reservations_enabled)
        <div class="container">
            <div class="row row-inner">
                <div class="col-sm-12">
                    <h3>Reservations</h3>
                    
                    @if($reservations->count() > 0)
                    <div class="panel panel-default">
                    <table class="table p-table">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Sex</th>
                            <th>Phone</th>
                            <th>ESN card number</th>
                            <th>Detail</th>
                        </tr>
                        @foreach($reservations as $item)
                            <tr>
                                <td>
                                @if((isset($item->buddy) && Auth::user()->can('acl', 'buddy.view')) ||
                                            (isset($item->exchangeStudent) && Auth::user()->can('acl', 'exchangeStudents.view')))
                                        <a target="_blank" href="{{ ($item->exchangeStudent ?? $item->buddy)->getDetailLink() }}">
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
                                <td>
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
                    </table>
                    </div>
                    @else
                        No reservations
                    @endif
                </div>
            </div>
        </div>
    @endif
    
    <div class="container">
        <div class="d-flex align-items-center">
            <h3>Participants</h3>

            @if($particip->count() > 0)
            <div class="ml-auto">
                <a href="{{ url('/partak/trips/detail/'. $trip->id_trip . '/pdf' ) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-file-pdf"></i> Export PDF
                </a>
                <a href="{{ url('/partak/trips/detail/'. $trip->id_trip . '/excel' ) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-file-excel"></i> Export Excel (all info)
                </a>
            </div>
            @endif
        </div>

        @if($particip->count() > 0)
            <div class="panel panel-default">
                <table class="table p-table">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Sex</th>
                        <th>Phone</th>
                        <th>ESN card number</th>
                        <th>Detail</th>
                    </tr>
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
                            <td>
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
                </table>
            </div>
        @else Event doesn't have participants
        @endif
    </div>
@stop

