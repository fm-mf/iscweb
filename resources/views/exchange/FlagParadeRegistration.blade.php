@extends('web.layouts.layout')
@section('page')
<div class="statistics">
    @if($signIn)
        <h1>Flag parade</h1>
        <p>You are <strong>Sing In</strong></p>
        <form method="post" action="{{ '/FlagParade/' . $hash . '/delete' }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="submit" value="Sing Out">
        </form>
    @else
        <form method="post" action="{{ '/FlagParade/' . $hash }}">
            <h1>Do you want to participate in Flag parade?</h1>

            <p>Some randome text here</p>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="submit" value="I'm in">
        </form>
    @endif
    <div style="min-height: 400px"></div>
</div>
@stop