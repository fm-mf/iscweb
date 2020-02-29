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

    @foreach ($roles as $role)
        <div class="container">
            <h4>{{ $role['title'] }} <span class="badge badge-primary">{{ $role['users']->count() }}</span></h4>
            <div class="roles-users">
            @foreach($role['users'] as $user)
                <div class="col-md-5 d-flex py-1 align-items-center">
                    {{ $user->person->getFullName(false) }}
                    <div class="ml-auto">
                        <protectedbutton url="{{ url('partak/users/roles/remove/' . $user->id_user . '/' . $role['id_role']) }}"
                            protection-text="Remove role {{ $role['title'] }} from {{ $user->person->first_name }} {{ $user->person->last_name }}?"
                            button-style="btn-danger btn-sm"
                        >
                            <i class="fas fa-times"></i> Remove
                        </protectedbutton>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    @endforeach
@stop