@extends('tandem.layouts.layout')

@section('page')
    <h1>Edit your information</h1>
    {{ auth()->user() }}
@endsection
