@extends('partak.layout.subpage')

@section('subpage')
    <div class="container-fluid">
        <div class="row match-my-cols">
            <div class="col-sm-3 submenu matched-cols">
                <ul class="list-unstyled">
                    @can('acl', 'buddy.view')
                        <li @if(Request::is('/partak/users/*')) class="sub-active" @endif>
                            <a href="{{ url('partak/users/buddies') }}">Buddies</a>
                        </li>
                    @endcan
                    @can('acl', 'exchangeStudents.view')
                        <li>
                            <a href="{{ url('partak/users/exchange-students') }}">Exchange Students</a>
                        </li>
                    @endcan
                    @can('acl', 'exchangeStudents.register')
                        <li>
                            <a href="{{ url('partak/users/office-registration') }}">Office registration</a>
                        </li>

                        <li>
                            <a href="{{ url('partak/users/preregistrations') }}">Preregistrations</a>
                        </li>
                    @endcan

                    @can('acl', 'roles.view')
                            <li>
                                <a href="{{ url('partak/users/roles') }}">Roles</a>
                            </li>
                        @endcan

                        @can('acl', 'roles.view')
                            <li>
                                <a href="{{ url('partak/users/partaks') }}">Parťáks</a>
                            </li>
                        @endcan
                </ul>
            </div>
            <div class="col-sm-9 no-padding matched-cols">
                <div class="inner-content" id="protected">
                    @yield('inner-content')
                </div>
            </div>
        </div>
    </div>
@stop