@extends('layouts.buddyprogram.layout')

@section('content')

    <div class="container-fluid page">
        <h1>Profil zahraničního studenta</h1>

        <div class="row">
            <div class="col-sm-4 col-lg-2">
                @if ($avatar)
                <div class="avatar-view" title="Change the avatar">
                    <img src="{{ asset($avatar) }}" alt="Avatar" id="avatar">
                </div>
                @endif
            </div>
            <div class="col-sm-8 col-lg-10">
                <h2>{{ $exchangeStudent->person->first_name }} {{ $exchangeStudent->person->last_name }}</h2>
                <div class="row">
                    <div class="col-sm-6">
                        @if($exchangeStudent->country) <strong>Země</strong>: {{ $exchangeStudent->country->full_name }}<br> @endif
                        @if($exchangeStudent->school != "NULL") <strong>Škola</strong>: {{ $exchangeStudent->school }}<br> @endif
                        @if($exchangeStudent->sex) <strong>Pohlaví</strong>: {{ $exchangeStudent->sex === "F" ? "žena" : "muž" }}<br> @endif
                        @if($exchangeStudent->age)<strong>Věk</strong>: {{ date("Y") - $exchangeStudent->age -1}}-{{date("Y") - $exchangeStudent->age }} let <br>@endif
                        @if($exchangeStudent->faculty)<strong>Fakulta ČVUT</strong>: {{ $exchangeStudent->faculty->faculty }}<br> @endif
                        <strong>Samoplátce</strong>: {{ $exchangeStudent->isSelfPaying() ? 'ano' : 'ne' }}<br>
                    </div>
                    <div class="col-sm-6">
                        <strong>Datum příjezdu</strong>:
                        @if($exchangeStudent->arrival)
                            {{ $exchangeStudent->arrival->arrival->format('j. n. Y H:i') }} <br>
                        @else
                            Zatím nevyplněno <br>
                        @endif
                        <strong>Způsob příjezdu</strong>:
                        @if($exchangeStudent->arrival)
                            {{ $exchangeStudent->arrival->transportation->transportation }} <br>
                        @else
                            Zatím nevyplněno <br>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @if ($exchangeStudent->about)

        <div class="row">
            <div class="col-xs-12">
                <h3>Podrobosti</h3>
                <p>{{ $exchangeStudent->about }}</p>
            </div>
        </div>
        @endif
        <div class="row buddy-actions">
            @if(count($errors) > 0)
                @foreach($errors->all() as $error)
                    <div class="flash col-sm-6">{{$error}}</div>
                @endforeach
            @endif
            @if(!$exchangeStudent->hasBuddy() && $casChoose)
                <a href="{{ url('muj-buddy/become-buddy/' . $exchangeStudent->id_user) }}" class="btn btn-primary btn">Staň se jeho / jejím Buddym.</a>
            @elseif ($exchangeStudent->id_buddy === Auth::id())
                <div class="show-email col-sm-6">
                    <strong>{{ $exchangeStudent->person->first_name }} {{ $exchangeStudent->person->last_name }}</strong> je tvým Buddym!
                    Teď mu můžeš napsat na <a href="mailto:{{ $exchangeStudent->person->user->email }}">{{ $exchangeStudent->person->user->email }}</a>
                </div>
            @else
                    <div class="show-email col-sm-6">
                        <p>Vyčerpán denní limit (1) pro výběr zahraničních studentů</p>
                    </div>
            @endif
            <p class="show-info col-sm-12">V případě, že chceš zahraničního studenta odebrat ze svých buddíků, napiš na <a href="mailto:buddy@isc.cvut.cz">buddy@isc.cvut.cz</a></p>

        </div>
    </div>

@stop

@section('stylesheets')
    @parent
    <style>
        [v-cloak] {
            display: none;
        }
    </style>
@stop

@section('scripts')
    @parent
    <script src="https://cdn.jsdelivr.net/vue.multiselect/2.0/vue-multiselect.min.js"></script>
    <script src="{{ asset('/js/app.js') }}"></script>
@stop

@include('footer')