<h3>{{ (isset($label))? $label : 'Find an Exchange Student' }}</h3>

<auto-complete
    url="{{ url('api/autocomplete/exchange-students') }}"
    @if (!isset($create) || $create) create-url="{{ url('partak/users/office-registration/create') }}" @endif
    :fields="[
        {title: 'All', columns: ['person.first_name', 'person.last_name', 'person.user.email', 'esn_card_number']},
        {title: 'Name', columns: ['person.first_name', 'person.last_name']},
        {title: 'Email', columns: ['person.user.email']},
        {title: 'Esn card', columns: ['esn_card_number']},
    ]"
    :topline="['person.first_name', 'person.last_name']"
    :subline="['person.user.email']"
    placeholder="Find an Exchange student..."
    target="{{ (isset($target))? $target : '/partak/users/exchange-students/{id_user}' }}"
    :image="{url: '/avatars/', file: 'person.user.avatar'}"
    show-semesters
>
</auto-complete>
