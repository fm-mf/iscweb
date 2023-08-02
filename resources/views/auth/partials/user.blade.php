<fieldset>
    <legend>@lang('auth.registration')</legend>
    <div class="row">
        <div class="form-group col-sm-6">
            @php
                $isInvalid = $errors->has('first_name') ? ' is-invalid' : '';
            @endphp
            {{ Form::label('first_name', __('auth.profile.given-names'), ['class' => 'required']) }}
            {{ Form::text('first_name', null, ['class' => 'form-control' . $isInvalid, 'required' => 'required', 'placeholder' => __('auth.profile.placeholder.given-names'), 'autofocus' => 'autofocus', 'autocomplete' => 'given-name']) }}
            @error('first_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-sm-6">
            @php
                $isInvalid = $errors->has('last_name') ? ' is-invalid' : '';
            @endphp
            {{ Form::label('last_name', __('auth.profile.surname'), ['class' => 'required']) }}
            {{ Form::text('last_name', null, ['class' => 'form-control' . $isInvalid, 'required' => 'required', 'placeholder' => __('auth.profile.placeholder.surname'), 'autocomplete' => 'family-name']) }}
            @error('last_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group">
        @php
            $isInvalid = $errors->has('email') ? ' is-invalid' : '';
        @endphp
        {{ Form::label('email', __('auth.e-mail'), ['class' => 'required']) }}
        {{ Form::email('email', null, ['class' => 'form-control' . $isInvalid, 'required' => 'required', 'placeholder' => __('auth.placeholder.e-mail'), 'autocomplete' => 'username']) }}
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        @php
            $isInvalid = $errors->has('password') ? ' is-invalid' : '';
        @endphp
        {{ Form::label('password', __('auth.password'), ['class' => 'required']) }}
        {{ Form::password('password', ['class' => 'form-control' . $isInvalid, 'required' => 'required', 'minlength' => 8, 'placeholder' => __('auth.placeholder.password'), 'autocomplete' => 'new-password']) }}
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <small class="form-text text-muted">@lang('auth.password-note')</small>
    </div>
    <div class="form-group">
        {{ Form::label('password_confirmation', __('auth.password-confirmation'), ['class' => 'required']) }}
        {{ Form::password('password_confirmation', ['class' => 'form-control', 'required' => 'required', 'minlength' => 8, 'placeholder' => __('auth.placeholder.password-confirmation'), 'autocomplete' => 'new-password']) }}
    </div>
</fieldset>
