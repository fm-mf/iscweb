@extends('partak.users.layout')
@section('inner-content')
    @if(count($errors) > 0)
    <div class="error top-message">
        @foreach($errors->all() as $error)
            <div class="flash col-sm-6">{!! $error !!}</div>
        @endforeach
    </div>
    @endif

    @if(session('successRemove'))
        <div class="success top-message">
            <i class="fas fa-check mr-1"></i> {!! session('successRemove') !!}
        </div>
    @endif

    <div class="container">
        <div class="d-flex align-items-center">
            <h3>List of parťáks</h3>
            <div class="ml-auto">We have <span class="badge badge-info">{{ $partaks->count() }}</span> parťáks!</div>
        </div>

        <table class="table p-table">
            @foreach($partaks as $partak)
            <tr>
                <td>@include("partak.components.user-link", ['user' => $partak->person])</td>
                <td>{{ $partak->email }}</td>
                <td align="right">
                    <protectedbutton
                        url="{{ url('partak/users/roles/remove/' . $partak->id_user . '/partak') }}"
                        protection-text="Remove {{ $partak->person->first_name }} {{ $partak->person->last_name }} from Partaks?"
                        button-style="btn-danger btn-xs align-right"
                    >
                        <span class="fas fa-times"></span> Remove
                    </protectedbutton>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
@stop
