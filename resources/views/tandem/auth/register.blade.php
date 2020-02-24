@extends('tandem.layouts.layout')

@section('title', 'Registration – Tandem Database')

@section('page')
    <section>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1>Registration to Tandem Database</h1>
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
                            <label class="required" for="input-email">E-mail</label>
                            <input type="email" class="form-control" name="email" id="input-email" value="{{ old('email') }}" required="required" placeholder="Enter your e-mail address" />
                        </div>
                        <div class="form-group">
                            <label class="required" for="input-password">Password</label>
                            <input type="password" class="form-control" name="password" id="input-password" required="required" placeholder="Enter your password" />
                            <small class="form-text text-muted">At least 8 characters</small>
                        </div>
                        <div class="form-group">
                            <label class="required" for="input-password-confirmation">Password confirmation</label>
                            <input type="password" class="form-control" name="password_confirmation" id="input-password-confirmation" required="required" placeholder="Confirm your password" />
                        </div>
                        <div class="form-group">
                            <label class="required" for="input-first-name">First name</label>
                            <input type="text" class="form-control" name="firstName" id="input-first-name" value="{{ old('firstName') }}" required="required" placeholder="First name" />
                        </div>
                        <div class="form-group">
                            <label for="input-last-name">Last name</label>
                            <input type="text" class="form-control" name="lastName" id="input-last-name" value="{{ old('lastName') }}" placeholder="Last name" />
                        </div>
                        <div class="form-group">
                            <label for="select-country">Country</label>
                            <vue-multiselect
                                    id="select-country"
                                    :options="{{ $countries }}"
                                    label="full_name"
                                    track-by="id_country"
                                    :multiple="false"
                                    v-model="country"
                                    :value="61"
                                    placeholder="Select your country">
                            </vue-multiselect>
                            <input type="hidden" name="country" :value="countryId" />
                        </div>
                        <div class="form-group">
                            <label for="input-about">About me</label>
                            <textarea class="form-control" placeholder="Some information about you" name="about" id="input-about">{{ old('about') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="select-languages-learn" class="required">I would like to learn</label>
                            <vue-multiselect
                                    id="select-languages-learn"
                                    :options="{{ $languages }}"
                                    label="language"
                                    track-by="id_language"
                                    :multiple="true"
                                    v-model="languagesToLearn"
                                    placeholder="Languages to learn"
                                    value="{{ collect(old('languagesToLearn')) }}"
                                    :limit="3">
                            </vue-multiselect>
                            <input type="hidden" name="languagesToLearn[]" v-for="language in languagesToLearn" :value="language.id_language" :key="language.id_language" required="required" />
                        </div>
                        <div class="form-group">
                            <label for="select-languages-teach" class="required">I would like to teach</label>
                            <vue-multiselect
                                    id="select-languages-teach"
                                    :options="{{ $languages }}"
                                    label="language"
                                    track-by="id_language"
                                    :multiple="true"
                                    v-model="languagesToTeach"
                                    placeholder="Languages to teach"
                                    value="{{ collect(old('languagesToTeach')) }}"
                                    :limit="3">
                            </vue-multiselect>
                            <input type="hidden" name="languagesToTeach[]" v-for="language in languagesToTeach" :value="language.id_language" :key="language.id_language" required="required" />
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
