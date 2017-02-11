@extends('partak.users.layout')
@section('inner-content')
    @if(count($errors) > 0)
        <div class="row">
            <div class="row-inner">
                <div class="error">
        @foreach($errors->all() as $error)
            <div class="flash col-sm-6">{!! $error !!}</div>
        @endforeach
                </div>
            </div>
        </div>
    @endif

    @if(session('successRemove'))
        <div class="row">
            <div class="row-inner">
                <div class="success">
                    <span class="glyphicon glyphicon-ok" style="padding-right:5px;"></span> {!! session('successRemove') !!}
                </div>
            </div>
        </div>
    @endif

    <div class="row-grey">
        <div class="container">
            <div class="row row-inner">
                <?php $i = 1; ?>
                @foreach($roles as $role)
                    <div class="col-sm-4">
                    <h4>{{ $role->title }}</h4>
                        <ul class="list-group">
                            @foreach($role->users as $user)
                                <li class="list-group-item">
                                    {{ $user->person->first_name }} {{ $user->person->last_name }}
                                    <span style="float:right;">
                                    <protectedbutton url="{{ url('partak/users/roles/remove/' . $user->id_user . '/' . $role->id_role) }}"
                                                     protection-text="Remove role {{ $role->title }} from {{ $user->person->first_name }} {{ $user->person->last_name }}?"
                                                     button-style="btn-danger btn-xs align-right">Remove</protectedbutton></span>

                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @if($i % 3 == 0)
            </div>
        </div>
        <div class="container">
            <div class="row row-inner">
                        @endif
                        <?php ++$i ?>
                @endforeach
            </div>
        </div>
    </div>
@stop