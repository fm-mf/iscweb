@extends('layouts.buddyprogram.layout')

@section('content')

    <div class="container page">
        <div class="card-body">
            <h1 class="text-center card-title">Profil zahraničního studenta</h1>

            <div class="row">
                <div class="col-12 col-md-9 order-md-first order-last">
                    <h2>{{ $exchangeStudent->person->first_name }} <span class="last-name">{{ $exchangeStudent->person->last_name }}</span></h2>
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
                                {{ $exchangeStudent->arrival->arrivalFormatted }} <br>
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
                    <div class="avatar-view" title="Profile picture">
                        @isset($exchangeStudent->person->avatar)
                            <img src="{{ asset($avatar) }}" alt="Avatar" id="avatar">
                        @else
                            <i class="fas fa-user-circle fa-9x" id="avatar"></i>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @if ($exchangeStudent->about)
            <div class="card-body">
                <div class="row">
                    <div class="container">
                        <h3>Podrobosti</h3>
                        <p>{{ $exchangeStudent->about }}</p>
                    </div>
                </div>
            </div>
        @endif
        <div class="card-body">
            @if(count($errors) > 0)
                @foreach($errors->all() as $error)
                    <div class="flash col-sm-6">{{$error}}</div>
                @endforeach
            @endif
            @if(!$exchangeStudent->hasBuddy() && $canChoose)
                <form method="POST" action="{{ route('become-buddy', ['exchageStudent' => $exchangeStudent->hashId]) }}">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-primary">Staň se @if ($exchangeStudent->person->sex === 'M')jeho @elseif($exchangeStudent->person->sex === 'F')jejím @endif buddym</button>
                </form>
            @elseif ($exchangeStudent->id_buddy === auth()->id())
                <div class="show-email">
                    <p><strong>{{ $exchangeStudent->person->first_name }} {{ $exchangeStudent->person->last_name }}</strong> je tvým Buddym!</p>
                    <p>Teď @if ($exchangeStudent->person->sex === 'M')mu @elseif($exchangeStudent->person->sex === 'F')jí @endif můžeš napsat! Dostupné kontakty:</p>
                    <ul class="contacts-list">
                        <li><i class="fas fa-envelope fa-fw" alt="E-mail" title="E-mail"></i> <a href="mailto:{{ $exchangeStudent->person->user->email }}">{{ $exchangeStudent->person->user->email }}</a></li>
                        @if ($exchangeStudent->whatsapp)
                            <li><i class="fab fa-whatsapp fa-fw" alt="WhatsApp" title="WhatsApp"></i> <a href="tel:{{ $exchangeStudent->whatsAppFormattedE164w }}">{{ $exchangeStudent->whatsAppFormattedInternational }}</a></li>
                        @endif
                        @if ($exchangeStudent->facebook)
                            <li><i class="fab fa-facebook fa-fw" alt="Facebook" title="Facebook"></i> <a href="{{ $exchangeStudent->facebook }}">{{ $exchangeStudent->facebook }}</a></li>
                        @endif
                    </ul>
                </div>
            @else
                <div class="show-email">
                    <p>Vyčerpán denní limit ({{ $limit }}) pro výběr zahraničních studentů</p>
                </div>
            @endif
        </div>
        @if ($exchangeStudent->id_buddy === auth()->id())
            <div class="card-body">
                <p class="show-info">V případě, že chceš zahraničního studenta odebrat ze svých buddíků, napiš na <a href="mailto:buddy@isc.cvut.cz">buddy@isc.cvut.cz</a></p>
            </div>
        @endif
    </div>

@stop
