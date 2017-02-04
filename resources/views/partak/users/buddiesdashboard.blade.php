@extends('partak.users.layout')
@section('inner-content')
    <div class="row search-buddy">
        <div class="row-inner">
            <div class="col-sm-8 col-sm-offset-0" id="search">
            <h3>Vyhledávání</h3>

                <autocomplete url="{{ url('api/autocomplete/buddies') }}"
                              :fields="[
                                    {title: 'Vše', columns: ['person.first_name', 'person.last_name', 'person.user.email']},
                                    {title: 'Name', columns: ['person.first_name', 'person.last_name']},
                                    {title: 'Email', columns: ['person.user.email']},
                                     ]"
                              :topline="['person.first_name', 'person.last_name']"
                              :subline="['person.user.email']"
                              placeholder="Hledat buddíka..."
                              target="/partak/users/buddy/{person.id_user}"
                              :image="{url: '/avatars/', file: 'person.user.avatar'}">
                </autocomplete>
            </div>
        </div>
    </div>
    <div class="row row-grey">
        <div class="row-inner">
            <div class="col-sm-12">
                <h3>Not verified Buddies</h3>
                <ul class="list-group">
                    @foreach($notVerifiedBuddies as $buddy)
                        <li class="list-group-item">{{ $buddy->person->first_name }}</li>
                    @endforeach
                </ul>
            </div><!-- /col -->
        </div>
    </div>

@stop

@section('scripts')
    @parent
    <script src="{{asset('js/search.js')}}"></script>
    @stop
