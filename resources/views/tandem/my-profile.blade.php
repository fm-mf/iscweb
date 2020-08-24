@extends('tandem.layouts.layout')

@section('title', __('tandem.my-profile.title') . ' – ' . __('tandem.page-title'))

@section('page')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-xl-8 mx-auto">
                    {{ Form::model($tandemUser, ['method' => 'patch', 'route' => 'tandem.my-profile', 'id' => 'vue-form') }}
                        <div class="form-group">
                            {{ Form::label('email', __('tandem.auth.e-mail'), ['class' => 'required']) }}
                            {{ Form::email('email', $tandemUser->email, ['class' => 'form-control', 'disabled' => 'disabled', 'required' => 'required']) }}
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    {{ Form::label('first_name', __('tandem.profile.given-names'), ['class' => 'required']) }}
                                    {{ Form::text('first_name', $tandemUser->first_name, ['class' => 'form-control', 'disabled' => 'disabled', 'required' => 'required']) }}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('last_name', __('tandem.profile.surname')) }}
                                    {{ Form::text('last_name', $tandemUser->last_name, ['class' => 'form-control', 'placeholder' => __('tandem.profile.placeholder.surname')]) }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('select-country', __('tandem.profile.country')) }}
                            <vue-multiselect
                                    id="select-country"
                                    :options="{{ $countries }}"
                                    label="full_name"
                                    track-by="id_country"
                                    :multiple="false"
                                    v-model="country"
                                    value="{{ $tandemUser->country }}"
                                    placeholder="@lang('tandem.profile.placeholder.country')">
                            </vue-multiselect>
                            <input type="hidden" name="country" :value="countryId" />
                        </div>
                        <div class="form-group">
                            <label for="input-about">@lang('tandem.profile.about-me')</label>
                            <textarea class="form-control" placeholder="@lang('tandem.profile.placeholder.about-me')" name="about" id="input-about">{{ old('about') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="select-languages-learn" class="required">@lang('tandem.profile.i-want-to-learn')</label>
                            <vue-multiselect
                                    id="select-languages-learn"
                                    :options="{{ $languages }}"
                                    label="language"
                                    track-by="id_language"
                                    :multiple="true"
                                    v-model="languagesToLearn"
                                    placeholder="@lang('tandem.profile.placeholder.i-want-to-learn')"
                                    value="{{ $tandemUser->languagesToLearn }}"
                                    allow-empty="false"
                                    max="5"
                                    :limit="3">
                            </vue-multiselect>
                            <input type="hidden" name="languagesToLearn[]" v-for="language in languagesToLearn" :value="language.id_language" :key="language.id_language" required="required" />
                        </div>
                        <div class="form-group">
                            <label for="select-languages-teach" class="required">@lang('tandem.profile.i-want-to-teach')</label>
                            <vue-multiselect
                                    id="select-languages-teach"
                                    :options="{{ $languages }}"
                                    label="language"
                                    track-by="id_language"
                                    :multiple="true"
                                    v-model="languagesToTeach"
                                    placeholder="@lang('tandem.profile.placeholder.i-want-to-teach')"
                                    value="{{ $tandemUser->languagesToTeach }}"
                                    allow-empty="false"
                                    max="5"
                                    :limit="3">
                            </vue-multiselect>
                            <input type="hidden" name="languagesToTeach[]" v-for="language in languagesToTeach" :value="language.id_language" :key="language.id_language" required="required" />
                        </div>
                        <button type="submit" class="btn btn-primary">@lang('tandem.profile.update')</button>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </section>
@endsection
