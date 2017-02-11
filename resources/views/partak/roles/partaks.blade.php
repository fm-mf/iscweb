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
                <h3>List of parťáks</h3>
                <div class="panel panel-default" id="protected">
                    <table class="table">
                        @foreach($partaks as $partak)
                        <tr>
                            <td>{{ $partak->person->first_name }} {{ $partak->person->last_name }}</td>
                            <td>{{ $partak->email }}</td>
                            <td align="right">
                                <protectedbutton url="{{ url('partak/users/roles/remove/' . $partak->id_user . '/partak') }}"
                                                 protection-text="Remove {{ $partak->person->first_name }} {{ $partak->person->last_name }} from Partaks?"
                                                 button-style="btn-danger btn-xs align-right">Remove</protectedbutton>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <h4>We have {{ $partaks->count() }} parťáks!</h4>
            </div>
        </div>
    </div>
@stop