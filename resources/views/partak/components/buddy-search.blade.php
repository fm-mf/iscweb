<h3>{{ (isset($label))? $label : 'Find a Buddy' }}</h3>

<auto-complete
    url="{{ url('api/autocomplete/buddies') }}"
    :fields="[
        {title: 'All', columns: ['person.first_name', 'person.last_name', 'person.user.email']},
        {title: 'Name', columns: ['person.first_name', 'person.last_name']},
        {title: 'Email', columns: ['person.user.email']},
    ]"
    :topline="['person.first_name', 'person.last_name']"
    :subline="['person.user.email']"
    placeholder="Find a buddy..."
    target="{{ (isset($target))? $target : '/partak/users/buddies/{id_user}' }}"
    :image="{url: '/avatars/', file: 'person.user.avatar'}"
>
</auto-complete>
