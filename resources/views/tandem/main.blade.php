@extends('tandem.layouts.layout')

@section('page')
    <h1>Logged in</h1>
    {{ auth()->user() }}
@endsection
