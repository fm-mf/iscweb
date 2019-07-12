@extends('layouts.buddyprogram.layout')

@section('content')

    <div class="container page">
        <div class="card-body">
            <h1 class="text-center card-title">Profil zahraničního studenta</h1>

            <div class="row">
                <div class="col-12 col-md-9 order-md-first order-last">
                    <h2>{{ $exchangeStudent->person->first_name }} {{ $exchangeStudent->person->last_name }}</h2>
                    <div class="row">
                        <div class="col">
                            @if($exchangeStudent->country) <strong>Země</strong>: {{ $exchangeStudent->country->full_name }}<br> @endif
                            @if($exchangeStudent->school != "NULL") <strong>Škola</strong>: {{ $exchangeStudent->school }}<br> @endif
                            @if($exchangeStudent->person->sex) <strong>Pohlaví</strong>: {{ $exchangeStudent->person->sex === "F" ? "žena" : "muž" }}<br> @endif
                            @if($exchangeStudent->person->age)<strong>Věk</strong>: {{ date("Y") - $exchangeStudent->person->age -1}}-{{date("Y") - $exchangeStudent->person->age }} let <br>@endif
                            @if($exchangeStudent->faculty)<strong>Fakulta ČVUT</strong>: {{ $exchangeStudent->faculty->faculty }}<br> @endif
                            <strong>Samoplátce</strong>: {{ $exchangeStudent->isSelfPaying() ? 'ano' : 'ne' }}<br>
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
                            <strong>Ubytování</strong>: {{ $exchangeStudent->accommodation->full_name }} <br>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3 ">
                    @if ($avatar)
                        <div class="avatar-view" title="Profile picture">
                            <i class="fas fa-user-circle" id="avatar"></i>
                            <!--<img src="{{ asset($avatar) }}" alt="Avatar" id="avatar" style="max-width:100%">-->
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            @if ($exchangeStudent->about)

                <div class="row">
                    <div class="container">
                        <h3>Podrobosti</h3>
                        <p>{{ $exchangeStudent->about }}</p>
                    </div>
                </div>
            @endif
        </div>
        <div class="card-body">
            @if(count($errors) > 0)
                @foreach($errors->all() as $error)
                    <div class="flash col-sm-6">{{$error}}</div>
                @endforeach
            @endif
            @if(!$exchangeStudent->hasBuddy() && $casChoose)
                <a href="{{ url('muj-buddy/become-buddy/' . $exchangeStudent->id_user) }}" class="btn btn-primary btn">Staň se jeho / jejím Buddym.</a>
            @elseif ($exchangeStudent->id_buddy === Auth::id())
                <div class="show-email">
                    <strong>{{ $exchangeStudent->person->first_name }} {{ $exchangeStudent->person->last_name }}</strong> je tvým Buddym! <br>
                    Teď mu můžeš napsat na <a href="mailto:{{ $exchangeStudent->person->user->email }}">{{ $exchangeStudent->person->user->email }}</a>
                </div>
            @else
                <div class="show-email">
                    <p>Vyčerpán denní limit (1) pro výběr zahraničních studentů</p>
                </div>
            @endif
            <p class="show-info">V případě, že chceš zahraničního studenta odebrat ze svých buddíků, napiš na <a href="mailto:buddy@isc.cvut.cz">buddy@isc.cvut.cz</a></p>
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
    <script src="{{ asset('echaechangestudentslist.jsdentslist.js') }}"></script>
@stop

@include('footer')