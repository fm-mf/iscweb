@extends('tandem.layouts.layout')

@section('title', __('tandem.profile.title', ['name' => $tandemUser->first_name]) . ' – ' . __('tandem.page-title'))

@section('page')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-xl-8 mx-auto">
                    <h1>@lang('tandem.profile.title', ['name' => $tandemUser->first_name])</h1>
                    <dl class="list-unstyled row user-profile">
                        <dt class="col-4">@lang('tandem.profile.name')</dt>
                        <dd class="col-8">{{ $tandemUser->full_name }}</dd>
                        <dt class="col-4">@lang('tandem.profile.i-am-from')</dt>
                        <dd class="col-8">{{ $tandemUser->country->full_name ?? null }}</dd>
                        <dt class="col-4">@lang('tandem.profile.about-me')</dt>
                        <dd class="col-8">{{ $tandemUser->about }}</dd>
                        <dt class="col-4">@lang('tandem.profile.i-want-to-learn')</dt>
                        <dd class="col-8">{{ implode(', ', $tandemUser->languagesToLearn->pluck('language')->all()) }}</dd>
                        <dt class="col-4">@lang('tandem.profile.i-want-to-teach')</dt>
                        <dd class="col-8">{{ implode(', ', $tandemUser->languagesToTeach->pluck('language')->all()) }}</dd>
                        <dt class="col-4">@lang('tandem.auth.e-mail')</dt>
                        <dd class="col-8">
                            <a href="mailto:{{ $tandemUser->email }}">{{ $tandemUser->email }}</a>
                        </dd>
                    </dl>
                    <div class="form-group">
                        <a href="{{ route('tandem.main') }}" class="btn btn-outline-primary">
                            <span class="fas fa-arrow-left"></span>
                            @lang('tandem.profile.back')
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
