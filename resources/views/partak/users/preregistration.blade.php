@extends('partak.users.layout')

@section('inner-content')
    <div class="container">
        <h3>Search</h3>

        <autocomplete url="{{ url('api/autocomplete/exchange-students') }}"
                        :fields="[
                            {title: 'All', columns: ['person.first_name', 'person.last_name', 'person.user.email', 'esn_card_number']},
                            {title: 'Name', columns: ['person.first_name', 'person.last_name']},
                            {title: 'Email', columns: ['person.user.email']},
                            {title: 'Esn card', columns: ['esn_card_number']},
                                ]"
                        :topline="['person.first_name', 'person.last_name']"
                        :subline="['person.user.email']"
                        placeholder="Search Exchange student..."
                        target="/partak/users/preregistrations/{id_user}"
                        :image="{url: '/avatars/', file: 'person.user.avatar'}">
        </autocomplete>
    </div>

    <div class="container">
        <preregister url="{{ url('api/load-preregister') }}" :current-id="{{ $currentId }}"></preregister>
    </div>
@stop