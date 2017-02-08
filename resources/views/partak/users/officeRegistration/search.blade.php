<div class="container">
    <div class="row search-buddy">
        <div class="row-inner">
            <div class="col-sm-8 col-sm-offset-0">
                <h3>{{ (isset($label))? $label : 'Search' }}</h3>

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
                              target="{{ (isset($target))? $target : '/partak/users/office-registration/registration/{id_user}' }}"
                              :image="{url: '/avatars/', file: 'person.user.avatar'}">
                </autocomplete>
            </div>
        </div>
    </div>
</div>