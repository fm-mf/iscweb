@extends('web.layouts.layout')
@section('title', $page->title)

@section('page')
<div class="container coronavirus">
    <h2>{{ $page->title }}</h2>

    <p class="coronavirus-lastupdate">Last updated at <span class="date">{{ $page->updated_at }}</span></p>

    <div class="coronavirus-content">
        {!! $page->content !!}
    </div>
</div>
@endsection