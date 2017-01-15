@extends('layouts.buddyprogram.layout')
@section('content')
    @if($myStudents)
    @foreach($myStudents as $student)
        {{ $student->person->first_name }}<br>
    @endforeach
    @endif
@stop