@extends('partak.layout.subpage')

@section('content')
    <div class="container-fluid">
        <div class="row match-my-cols">
            <div class="col-sm-3 submenu matched-cols">
                <ul class="list-unstyled">
                    @can('acl', 'settings.edit')
                        <li @if(Request::is('partak/settings')) class="sub-active" @endif>
                            <a href="{{ url('partak/settings') }}">General</a>
                        </li>
                        <li @if(Request::is('partak/settings/contacts')) class="sub-active" @endif>
                            <a href="{{ url('partak/settings/contacts') }}">Contacts</a>
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
