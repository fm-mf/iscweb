<div class="form-group">
    {{ Form::label('select-country', __('tandem.profile.country')) }}
    <vue-multiselect
        id="select-country"
        class="{{ $errors->has('country') ? 'is-invalid' : '' }}"
        :options="{{ $countries }}"
        label="full_name"
        track-by="id_country"
        :multiple="false"
        v-model="country"
        placeholder="@lang('tandem.profile.placeholder.country')"
        select-label="@lang('tandem.profile.select-label')"
        selected-label="@lang('tandem.profile.selected-label')"
        deselect-label="@lang('tandem.profile.deselect-label')"
    >
        <template slot="noResult">@lang('tandem.profile.no-results')</template>
        <template slot="noOptions">@lang('tandem.profile.no-options')</template>
    </vue-multiselect>
    @if($errors->has('country'))
        <div class="invalid-feedback">{{ $errors->first('country') }}</div>
    @endif
    <input type="hidden" name="country" :value="countryId" />
</div>
<div class="form-group">
    <label for="input-about">@lang('tandem.profile.about-me')</label>
    <textarea
        class="form-control"
        placeholder="@lang('tandem.profile.placeholder.about-me')"
        name="about"
        id="input-about"
        rows="5"
    >{{ old('about') }}</textarea>
</div>
<div class="form-group">
    <label for="select-languages-learn" class="required">@lang('tandem.profile.i-want-to-learn')</label>
    <vue-multiselect
        id="select-languages-learn"
        class="{{ $errors->has('languagesToLearn') ? 'is-invalid' : '' }}"
        :options="{{ $languages }}"
        label="language"
        track-by="id_language"
        :multiple="true"
        v-model="languagesToLearn"
        placeholder="@lang('tandem.profile.placeholder.i-want-to-learn')"
        select-label="@lang('tandem.profile.select-label')"
        selected-label="@lang('tandem.profile.selected-label')"
        deselect-label="@lang('tandem.profile.deselect-label')"
        :allow-empty="false"
        :close-on-select="false"
        :max="5"
    >
        <template slot="maxElements">@lang('tandem.profile.selected-max-elements', ['max' => 5])</template>
        <template slot="noResult">@lang('tandem.profile.no-results')</template>
        <template slot="noOptions">@lang('tandem.profile.no-options')</template>
    </vue-multiselect>
    @if($errors->has('languagesToLearn'))
        <div class="invalid-feedback">{{ $errors->first('languagesToLearn') }}</div>
    @endif
    <small class="form-text text-muted">
        @lang('tandem.profile.languages-select-note')
    </small>
    <input type="hidden" name="languagesToLearn[]" v-for="language in languagesToLearn" :value="language.id_language" :key="language.id_language" required="required" />
</div>
<div class="form-group">
    <label for="select-languages-teach" class="required">@lang('tandem.profile.i-want-to-teach')</label>
    <vue-multiselect
        id="select-languages-teach"
        class="{{ $errors->has('languagesToTeach') ? 'is-invalid' : '' }}"
        :options="{{ $languages }}"
        label="language"
        track-by="id_language"
        :multiple="true"
        v-model="languagesToTeach"
        placeholder="@lang('tandem.profile.placeholder.i-want-to-teach')"
        select-label="@lang('tandem.profile.select-label')"
        selected-label="@lang('tandem.profile.selected-label')"
        deselect-label="@lang('tandem.profile.deselect-label')"
        :allow-empty="false"
        :close-on-select="false"
        :max="5"
    >
        <template slot="maxElements">@lang('tandem.profile.selected-max-elements', ['max' => 5])</template>
        <template slot="noResult">@lang('tandem.profile.no-results')</template>
        <template slot="noOptions">@lang('tandem.profile.no-options')</template>
    </vue-multiselect>
    @if($errors->has('languagesToTeach'))
        <div class="invalid-feedback">{{ $errors->first('languagesToTeach') }}</div>
    @endif
    <small class="form-text text-muted">
        @lang('tandem.profile.languages-select-note')
    </small>
    <input type="hidden" name="languagesToTeach[]" v-for="language in languagesToTeach" :value="language.id_language" :key="language.id_language" required="required" />
</div>
