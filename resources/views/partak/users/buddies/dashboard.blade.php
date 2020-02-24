@extends('partak.users.layout')
@section('inner-content')
    <div class="container search-buddy">
            <div class="row row-inner">
                <div class="col-sm-8 col-sm-offset-0" id="search">
                <h3>Search Buddy</h3>

                    <autocomplete url="{{ url('api/autocomplete/buddies') }}"
                                  :fields="[
                                        {title: 'All', columns: ['person.first_name', 'person.last_name', 'person.user.email']},
                                        {title: 'Name', columns: ['person.first_name', 'person.last_name']},
                                        {title: 'Email', columns: ['person.user.email']},
                                         ]"
                                  :topline="['person.first_name', 'person.last_name']"
                                  :subline="['person.user.email']"
                                  placeholder="Search Buddy..."
                                  target="/partak/users/buddies/{id_user}"
                                  :image="{url: '/avatars/', file: 'person.user.avatar'}">
                    </autocomplete>
                </div>
            </div>
    </div>

    <div class="container">
        @if(session('success'))
            <div class="success top-message">
                <i class="fas fa-check mr-1"></i> {{ session('success')  }}
            </div>
        @endif

        @can('acl', 'buddy.verify')
            <h3>Not verified Buddies</h3>
            @if($notVerifiedBuddies->count() > 0)
            <div class="panel panel-default" id="protected">
                <table class="table p-table">
                    @foreach($notVerifiedBuddies->get() as $buddy)
                        <tr>
                            <td>@include('partak.components.user-link', ['user' => $buddy->person])</td>
                            <td>{{ $buddy->user()->email }}</td>
                            <td align="right">
                                <protectedbutton url="{{ url('partak/users/buddies/approve/' . $buddy->id_user) }}"
                                                    protection-text="Approve buddy {{ $buddy->person->getFullName() }}?"
                                                    button-style="btn-success btn-xs"><i class="fas fa-check mr-1"></i> Approve</protectedbutton>
                                <protectedbutton url="{{ url('partak/users/buddies/deny/' . $buddy->id_user) }}"
                                                    protection-text="Deny buddy {{ $buddy->person->getFullName() }}?"
                                                    button-style="btn-danger btn-xs"><i class="fas fa-times mr-1"></i> Deny</protectedbutton>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            @endif
        @endcan
    </div>

@stop
