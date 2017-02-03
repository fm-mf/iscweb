@extends('partak.users.layout')
@section('inner-content')
    {{ $buddy->person->first_name  }}
    @stop