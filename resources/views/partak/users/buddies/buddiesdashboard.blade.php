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
                              target="/partak/users/buddies/{id_user}"
                              :image="{url: '/avatars/', file: 'person.user.avatar'}">
                </autocomplete>
            </div>
        </div>
    </div>
    <div class="row row-grey">
        <div class="row-inner">
            <div class="col-sm-12">
                <h3>Not verified Buddies</h3>
                @if($notVerifiedBuddies->count() > 0)
                <div class="panel panel-default">
                    <table class="table">
                        @foreach($notVerifiedBuddies->get() as $buddy)
                            <tr>
                                <td>{{ $buddy->person->first_name }} {{ $buddy->person->last_name }}</td>
                                <td>{{ $buddy->user()->email }}</td>
                                <td align="right">
                                    <a href="{{ url('partak/users/buddies/verify/' . $buddy->id_user) }}" role="button" class="btn btn-success btn-xs">Approve</a>
                                    <a href="{{ url('partak/users/buddies/cancel/' . $buddy->id_user) }}" role="button" class="btn btn-danger btn-xs">Deny</a>
                                    <a href="{{ url('partak/users/buddies/' . $buddy->id_user) }}" role="button" class="btn btn-info btn-xs">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                @endif
            </div><!-- /col -->
        </div>
    </div>

@stop

@section('scripts')
    @parent
    <script src="{{asset('js/search.js')}}"></script>
    @stop
