@extends('partak.users.layout')
@section('inner-content')
    @if(count($errors) > 0)
        <div class="error">
            @foreach($errors->all() as $error)
                <div class="flash">{!! $error !!}</div>
            @endforeach
        </div>
    @endif

    @if(session('successRemove'))
        <div class="success top-message">
            <i class="fas fa-check mr-1"></i> {!! session('successRemove') !!}
        </div>
    @endif

    <div class="container">
        <div class="row">
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
        <div class="row">
                    @endif
                    <?php ++$i ?>
            @endforeach
        </div>
    </div>
@stop