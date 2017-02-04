@extends('partak.users.layout')
@section('inner-content')
    <div class="row search-buddy">
        <div class="col-sm-8 col-sm-offset-2" id="search">
            <autocomplete url="{{ url('api/autocomplete/buddies') }}"
                          :fields="[
                                {title: 'Vše', columns: ['person.first_name', 'person.last_name', 'person.user.email']},
                                {title: 'Name', columns: ['person.first_name', 'person.last_name']},
                                {title: 'Email', columns: ['person.user.email']},
                                 ]"
                          :topline="['person.first_name', 'person.last_name']"
                          :subline="['person.user.email']"
                          placeholder="Hledat buddíka..."
                          :image="{url: '/avatars/', file: 'person.user.avatar'}">
            </autocomplete>
        </div>
    </div>
    <div class="row">
        <h3>Not verified Buddies</h3>
        <ul class="list-group">
            @foreach($notVerifiedBuddies as $buddy)
                <li class="list-group-item">{{ $buddy->person->first_name }}</li>
            @endforeach
        </ul>
    </div>

@stop

@section('scripts')
    @parent
    <script src="{{asset('js/search.js')}}"></script>
    @stop
