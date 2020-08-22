@extends('tandem.layouts.layout')

@section('title', __('tandem.auth.registration') . ' – ' . __('tandem.page-title'))

@section('page')
    <section>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1>@lang('tandem.auth.registration-heading')</h1>
                </div>
            </div>
            @if($errors->any())
                <div class="row">
                    <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
                        @foreach($errors->all() as $error)
                            <p class="alert alert-danger">{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
                    <form action="{{ route('tandem.register') }}" method="POST" id="vue-form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="required" for="input-email">@lang('tandem.auth.e-mail')</label>
                            <input type="email" class="form-control" name="email" id="input-email" value="{{ old('email') }}" required="required" placeholder="@lang('tandem.auth.placeholder.e-mail')" />
                        </div>
                        <div class="form-group">
                            <label class="required" for="input-password">@lang('tandem.auth.password')</label>
                            <input type="password" class="form-control" name="password" id="input-password" required="required" placeholder="@lang('tandem.auth.placeholder.password')" minlength="8" />
                            <small class="form-text text-muted">@lang('tandem.auth.password-note')</small>
                        </div>
                        <div class="form-group">
                            <label class="required" for="input-password-confirmation">@lang('tandem.auth.password-confirmation')</label>
                            <input type="password" class="form-control" name="password_confirmation" id="input-password-confirmation" required="required" placeholder="@lang('tandem.auth.placeholder.password-confirmation')" minlength="8" />
                        </div>
                        <div class="form-group">
                            <label class="required" for="input-first-name">@lang('tandem.my-profile.given-names')</label>
                            <input type="text" class="form-control" name="firstName" id="input-first-name" value="{{ old('firstName') }}" required="required" placeholder="@lang('tandem.my-profile.placeholder.given-names')" />
                        </div>
                        <div class="form-group">
                            <label for="input-last-name">@lang('tandem.my-profile.surname')</label>
                            <input type="text" class="form-control" name="lastName" id="input-last-name" value="{{ old('lastName') }}" placeholder="@lang('tandem.my-profile.placeholder.surname')" />
                        </div>
                        <div class="form-group">
                            <label for="select-country">@lang('tandem.my-profile.country')</label>
                            <vue-multiselect
                                    id="select-country"
                                    :options="{{ $countries }}"
                                    label="full_name"
                                    track-by="id_country"
                                    :multiple="false"
                                    v-model="country"
                                    :value="61"
                                    placeholder="@lang('tandem.my-profile.placeholder.country')">
                            </vue-multiselect>
                            <input type="hidden" name="country" :value="countryId" />
                        </div>
                        <div class="form-group">
                            <label for="input-about">@lang('tandem.my-profile.about-me')</label>
                            <textarea class="form-control" placeholder="@lang('tandem.my-profile.placeholder.about-me')" name="about" id="input-about">{{ old('about') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="select-languages-learn" class="required">@lang('tandem.my-profile.i-want-to-learn')</label>
                            <vue-multiselect
                                    id="select-languages-learn"
                                    :options="{{ $languages }}"
                                    label="language"
                                    track-by="id_language"
                                    :multiple="true"
                                    v-model="languagesToLearn"
                                    placeholder="@lang('tandem.my-profile.placeholder.i-want-to-learn')"
                                    value="{{ collect(old('languagesToLearn')) }}"
                                    :limit="3">
                            </vue-multiselect>
                            <input type="hidden" name="languagesToLearn[]" v-for="language in languagesToLearn" :value="language.id_language" :key="language.id_language" required="required" />
                        </div>
                        <div class="form-group">
                            <label for="select-languages-teach" class="required">@lang('tandem.my-profile.i-want-to-teach')</label>
                            <vue-multiselect
                                    id="select-languages-teach"
                                    :options="{{ $languages }}"
                                    label="language"
                                    track-by="id_language"
                                    :multiple="true"
                                    v-model="languagesToTeach"
                                    placeholder="@lang('tandem.my-profile.placeholder.i-want-to-teach')"
                                    value="{{ collect(old('languagesToTeach')) }}"
                                    :limit="3">
                            </vue-multiselect>
                            <input type="hidden" name="languagesToTeach[]" v-for="language in languagesToTeach" :value="language.id_language" :key="language.id_language" required="required" />
                        </div>
                        <button type="submit" class="btn btn-primary">@lang('tandem.auth.register')</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
