@extends('partak.settings.layout')

@section('inner-content')
    <div class="container">
        @if($errors->any())
            <div class="container">
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="col-md-7">
            @if(isset($contact))
                {{ Form::model($contact, ['route' => ['partak.settings.contacts.update', $contact->id], 'method' => 'put', 'files' => true]) }}
            @else
                {{ Form::open(['route' => 'partak.settings.contacts.store', 'method' => 'post', 'files' => true]) }}
            @endif
            {{ Form::bsText('position', 'Position', 'required') }}
            {{ Form::bsEmail('email', 'Email', 'required') }}
            {{ Form::bsText('name', 'Name') }}
            {{ Form::bsTel('phone', 'Phone') }}
            {{ Form::bsSelect('photo', 'Photo', $photoTypes) }}
            {{ Form::bsFile('custom_photo_input', "Select custom photo", '', ["accept" => "image/jpeg"]) }}
            <div class="form-group" id="photo-preview-wrapper">
                @isset($photoSrc)
                    <img src="{{ $photoSrc }}" alt="Contact photo preview" />
                @endif
            </div>
            {{ Form::bsCheckbox('phone_visible', 'Show phone on web', false, true) }}
            {{ Form::bsCheckbox('visible', 'Show contact on web', false, true) }}
            @if(isset($contact))
                {{ Form::bsSubmit('Update') }}
            @else
                {{ Form::bsSubmit('Create') }}
            @endif
            {{ Form::close() }}
        </div>
    </div>
@endsection
