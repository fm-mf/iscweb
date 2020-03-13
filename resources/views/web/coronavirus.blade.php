@extends('web.layouts.layout')
@section('title', $page->title)

@section('description', 'Regularly updated information for exchange students about current coronavirus (COVID-19) situation in the Czech Republic and at CTU')

@section('page')
<div class="container coronavirus">
    <h1>{{ $page->title }}</h1>

    <p class="coronavirus-lastupdate">Last updated at <span class="date">{{ $page->updated_at }}</span></p>

    <div class="coronavirus-content">
        {!! $page->content !!}
    </div>
</div>
@endsection
