@extends('partak.trips.layout')
@section('inner-content')

    <div class="row-grey">
        <div class="container">
            <div class="row row-inner">
                @if( session('successUpdate'))
                    <div class="success">
                        <span class="glyphicon glyphicon-ok" style="padding-right:5px;"></span>{{ session('successUpdate') }}<br>
                    </div>
                    <div style="min-height: 30px"></div>
                @elseif(session('error'))
                    <div class="alert-danger">
                        <span class="glyphicon glyphicon-alert" style="padding-right:5px;"></span>{{ session('error') }}<br>
                    </div>
                    <div style="min-height: 30px"></div>
                @endif
                <div class="col-sm-8">
                    <div class="panel panel-default">
                        <table class="table">
                            <tr>
                                <th>Name</th>
                                <td>{{ $trip->event->name }}</td>
                            </tr>
                            <tr>
                                <th>From</th>
                                <td>{{ $trip->event->datetime_from->toFormattedDateString() }}</td>
                                <th>To</th>
                                <td>{{ $trip->trip_date_to->toFormattedDateString() }}</td>
                            </tr>
                            <tr>
                                <th>Capacity</th>
                                <td>{!! $trip->howIsFillWithDetail() !!}</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Price</th>
                                <td>{{ $trip->price }} Kč</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                            </tr>
                        </table>
                    </div>
                    @can('edit', $trip)
                        <a href="{{ url('/partak/trips/edit/' . $trip->id_trip) }}" role="button" class="btn btn-success btn-xs">Edit</a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row row-inner">
                <div class="col-sm-8">
                    <h3>Organizers</h3>
                    @if($organizers->count() > 0)
                        <div class="panel panel-default">
                            <table class="table">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                </tr>
                                @foreach($organizers as $organizer)
                                    <tr>
                                        <td>{{ $organizer->person->first_name .' '. $organizer->person->last_name}}</td>
                                        <td>{{ $organizer->person->user->email }}</td>
                                        <td>{{ $organizer->phone }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    @else Event doesn't have organizers
                    @endif

                </div>
            </div>
        </div>
        @if($trip->isOpen())
            @can('addParticipant', $trip)
                @if($trip->type === 'exchange' || $trip->type === 'ex+buddy')
                @include('partak.users.officeRegistration.search',[
                    'label' => 'Add Exchange student',
                    'target' => url('/partak/trips/detail/'. $trip->id_trip .'/add/{id_user}'),
                ])
                @endif
                @if($trip->type === 'buddy' || $trip->type === 'ex+buddy')
                    <div class="container">
                        <div class="row search-buddy">
                            <div class="row-inner">
                                <div class="col-sm-8 col-sm-offset-0">
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
                            </div>
                        </div>
                    </div>
                @endif
            @endcan
        @endif
        <div style="min-height: 300px">
            <div class="container">
                <div class="row row-inner">
                    <div class="col-sm-12">
                        <h3>Participants</h3>
                        @if($particip->count() > 0)
                            <div class="export-links">
                                <a href="{{ url('/partak/trips/detail/'. $trip->id_trip . '/pdf' ) }}" class="export-link export-link-pdf">
                                    <img src="{{ asset('img/partak/pdf.png') }}" width="35"> PDF
                                </a>
                                <a href="{{ url('/partak/trips/detail/'. $trip->id_trip . '/excel' ) }}" class="export-link export-link-pdf">
                                    <img src="{{ asset('img/partak/xls.png') }}" width="35"> Excel
                                </a>
                            </div>
                            <div class="panel panel-default">
                                <table class="table">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Sex</th>
                                        <th>Phone</th>
                                        <th>ESN cart number</th>
                                        <th>Detail</th>
                                    </tr>
                                    @foreach($particip as $participant)
                                        <tr>
                                            <td>@if($participant->trips()->wherePivot('stand_in', 'y')->where('trips.id_trip', $trip->id_trip)->exists()) <span class="glyphicon glyphicon-time"></span>@endif {{ $participant->person->last_name .' '. $participant->person->first_name}}</td>
                                            <td>{{ $participant->person->user->email }}</td>
                                            <td>{{ $participant->person->getSex() }}</td>
                                            <td>{{ $participant->phone }}</td>
                                            <td> @if($participant->whoAmI('exchangeStudent')) {{ $participant->esn_card_number }} @endif</td>
                                            <td> @if(($participant->whoAmI('buddy') && Auth::user()->can('acl', 'buddy.view')) ||
                                                        ($participant->whoAmI('exchangeStudent') && Auth::user()->can('acl', 'exchangeStudents.view')))
                                                    <a href="{{ $participant->getDetailLink() }}" role="button" class="btn btn-info btn-xs">Detail</a>
                                                @endif
                                                @can('viewPayment', $trip)
                                                    <a href="{{ url('partak/trips/'. $trip->id_trip .'/payment/' .$participant->pivot->id) }}" role="button" class="btn btn-info btn-xs">Payment</a>
                                                @endcan
                                                @can('removeParticipant', $trip)
                                                    <protectedbutton url="{{ url('partak/trips/'. $trip->id_trip .'/remove/' . $participant->id_user) }}"
                                                                     protection-text="Remove {{ $participant->person->first_name }} {{ $participant->person->last_name }} from event {{ $trip->name }}?"
                                                                     button-style="btn btn-danger btn-xs">Remove</protectedbutton>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        @else Event doesn't have participants
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

