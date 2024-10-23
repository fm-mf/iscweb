@extends('web.layouts.subpage')
@section('wrapper-class', 'voting-wrapper')
@section('navClass', 'navbar-light')
@section('title', 'inteGREAT Voting')

@section('content')
    <div class="container">
        <div class="row" style="padding: 50px 0 50px 0;">
            <div class="col-sm-6">
            @if( $alreadyVoted )
                <p class="success">We see that you have already cast your vote. Did you change your mind? No problem. Just note that with a new voting the previous record will be discarded.</p>
            @endif

            {{ Form::model(null, ['url' => '/voting/process', 'method' => 'post']) }}

            <input type="hidden" name="hash" value="{{ $hash }}">

            {{ Form::bsSelect('best_show', 'Best Show', $countriesList, $bestShow, ['placeholder' => 'Select best show...', 'class' => 'best-show']) }}
            <small class="form-text text-muted col-sm-12">Note: The country you come from <b>is not</b> in the list.</small>

            {{ Form::bsSelect('best_food', 'Best Food', $countriesList, $bestFood, ['placeholder' => 'Select best food...', 'class' => 'best-food']) }}
            <small class="form-text text-muted col-sm-12">Note: The country you come from <b>is not</b> in the list.</small>

            @if ( !$alreadyVoted )
                {{ Form::bsSubmit('Vote') }}
            @else
                {{ Form::bsSubmit('Update my vote') }}
            @endif


            {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
