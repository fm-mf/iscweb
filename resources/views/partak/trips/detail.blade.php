@extends('partak.trips.layout')
@section('inner-content')

    @if(session('successUpdate'))
        <div class="row">
            <div class="row-inner">
                <div class="success">
                    <span class="glyphicon glyphicon-ok" style="padding-right:5px;"></span> Profile was successfully updated.
                </div>
            </div>
        </div>
    @endif


    <div class="row-grey">
        <div class="container">
            <div class="row row-inner">
                <div class="col-sm-8">
                    <div class="panel panel-default">
                        <table class="table">
                            <tr>
                                <th>Name</th>
                                <td>{{ $trip->name }}</td>
                            </tr>
                            <tr>
                                <th>From</th>
                                <td>{{ $trip->datetime_from->toFormattedDateString() }}</td>
                                <th>To</th>
                                <td>{{ $trip->datetime_to->toFormattedDateString() }}</td>
                            </tr>
                            <tr>
                                <th>Capacity</th>
                                <td>@if($trip->isFull()) <b>Event is Full</b> @else{{ $trip->howIsfill() .'/'. $trip->capacity }}@endif</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>

                            </tr>
                        </table>
                    </div>
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
        {{ $Label = ($trip->isFull())? 'as stand in' : '' }}
        @include('partak.users.officeRegistration.search',['label' => 'Add Participant' .$Label, 'target' => url('/partak/trips/detail/'. $trip->id_event .'/add/{id_user}')])

        <div style="min-height: 300px">
            <div class="container">
                <div class="row row-inner">
                    <div class="col-sm-12">
                        <h3>Participants</h3>
                        @if($particip->count() > 0)
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
                                            <td>{{ $participant->person->first_name .' '. $participant->person->last_name}}</td>
                                            <td>{{ $participant->person->user->email }}</td>
                                            <td>{{ $participant->person->getSex() }}</td>
                                            <td>{{ $participant->phone }}</td>
                                            <td>{{ $participant->esn_card_number }}</td>
                                            <td><a href="{{ url('partak/users/exchange-students/' . $participant->id_user) }}" role="button" class="btn btn-info btn-xs">Detail</a>
                                                <protectedbutton url="{{ url('partak/trips/'. $trip->id_event .'/remove/' . $participant->id_user) }}"
                                                                 protection-text="Remove {{ $participant->person->first_name }} {{ $participant->person->last_name }} from event {{ $trip->name }}?"
                                                                 button-style="btn btn-danger btn-xs">Remove</protectedbutton>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        @else Event doesn't participants
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

