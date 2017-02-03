@extends('partak.layout.subpage')

@section('content')
    <div class="container-fluid">
        <div class="row match-my-cols">
            <div class="col-sm-3 submenu">
                <ul class="list-unstyled">
                    <li @if(Request::is('/partak/users')) class="sub-active" @endif>
                        <a href="{{ url('partak/users/buddies') }}">Buddies</a>
                    </li>
                    <li>
                        <a href="{{ url('partak/users/exchange-students') }}">Exchange Students</a>
                    </li>
                </ul>
            </div>
            <div class="col-sm-9">
                <div class="inner-content">
                    @yield('inner-content')
                </div>
            </div>
        </div>
    </div>
    @stop