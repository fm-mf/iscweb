@extends('auth.layouts.layout')

@section('title', __('auth.verification.title'))

@section('page')
    @component('components.alert-success', ['sessionKey' => 'verification_mail_sent'])
    @endcomponent

    <h1>@lang('auth.verification.title')</h1>

    @lang('auth.verification.info')

    <ul class="nav nav-tabs flex-nowrap" role="tablist">
        <li class="nav-item">
            <a href="#with-email" class="nav-link @error('email') active @enderror @error('domain') active @enderror" data-toggle="tab">
                @lang('auth.verification.with-email')
            </a>
        </li>
        <li class="nav-item">
            <a href="#without-email" class="nav-link @error('motivation') active @enderror" data-toggle="tab" >
                @lang('auth.verification.without-email')
            </a>
        </li>
    </ul>

    <div class="tab-content">
        <div id="with-email" class="pt-4 tab-pane fade @error('email') active show @enderror @error('domain') active show @enderror">
            {{ Form::open(['route' => 'auth.verification.email']) }}
                {{ Form::label('email', __('auth.verification.university-email'), ['class' => 'required']) }}
                <div class="form-row">
                    <div class="form-group col-sm">
                        @php
                            $isInvalid = $errors->has('email') ? ' is-invalid' : '';
                        @endphp
                        {{ Form::text('email', null, ['class' => 'form-control' . $isInvalid, 'required' => 'required', 'max' => '200', 'placeholder' => __('auth.verification.placeholder.university-email')]) }}
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">@lang('auth.verification.university-email-help')</small>
                    </div>
                    <div class="form-group col-sm-auto text-center at-symbol">@</div>
                    <div class="form-group col-sm">
                        @php
                            $isInvalid = $errors->has('domain') ? ' is-invalid' : '';
                        @endphp
                        {{ Form::select('domain', $allowedDomains, null, ['class' => 'form-control' . $isInvalid, 'required' => 'required', 'placeholder' => __('auth.verification.placeholder.domain')]) }}
                        @error('domain')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">@lang('auth.verification.domain-help')</small>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::button(__('auth.verification.send-link'), ['type' => 'submit', 'class' => 'btn btn-primary']) }}
                </div>
            {{ Form::close() }}
        </div>
        <div id="without-email" class="pt-4 tab-pane fade @error('motivation') active show @enderror">
            @lang('auth.verification.motivation-info')

            {{ Form::open(['route' => 'auth.verification.motivation']) }}
                <div class="form-group">
                    @php
                        $isInvalid = $errors->has('motivation') ? ' is-invalid' : '';
                    @endphp
                    {{ Form::label('motivation', __('auth.verification.motivation'), ['class' => 'required']) }}
                    {{ Form::textarea('motivation', null, ['class' => 'form-control' . $isInvalid, 'required' => 'required', 'max' => '16383', 'placeholder' => __('auth.verification.placeholder.motivation')]) }}
                    @error('motivation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    {{ Form::button(__('auth.verification.send'), ['type' => 'submit', 'class' => 'btn btn-primary']) }}
                </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            const tablist = document.querySelector('.nav.nav-tabs[role=tablist]');
            tablist.addEventListener('click', function () {
                this.scrollIntoView({block: 'start', inline: 'nearest', behavior: 'smooth'});
            });
        });
    </script>
@endsection
