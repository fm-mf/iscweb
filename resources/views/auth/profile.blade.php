@extends('layouts.user')

@section('content')
    <h1>Nastavení profilu</h1>
    <div class="row">
        <div class="col-sm-12">
            <p class="description">
                Tyto údaje jsou nepovinné. Jejich vyplnění nám však může ušetřit spoustu práce v případě, že nastanou problémy.
            </p>
        </div>
    </div>
    <div class="row lab">
        <label for="avatar">Profilová fotografie</label>
    </div>


    <div class="row" id="crop-avatar">

        <!-- Current avatar -->
        <div class="col-sm-5">
            <div class="avatar-view" title="Change the avatar">
                <img src="{{ URL::asset('auth/img/avatar.jpg') }}" alt="Avatar" id="avatar">
            </div>
        </div>
        <div class="col-sm-7">
            <p class="grey">Pro změnu profilové fotky klikni na obrázek. Maximální povolená velikost souboru je 2MB</p>
        </div>


        <!-- Cropping modal -->
        <div class="modal fade" id="avatar-modal" tabindex="-1" role="dialog" aria-labelledby="avatar-modal-label" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form class="avatar-form" method="post" action="{{ URL::asset('crop-avatar.php') }}" enctype="multipart/form-data">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" id="avatar-modal-label">Změna profilové fotky</h4>
                        </div>
                        <div class="modal-body">
                            <div class="avatar-body">

                                <!-- Upload image and data -->
                                <div class="avatar-upload">
                                    <input type="hidden" name="id" value=" {{ isset($user->id)?$user->id:"none" }}">
                                    <input class="avatar-src" name="avatar_src" type="hidden">
                                    <input class="avatar-data" name="avatar_data" type="hidden">
                                    <label for="avatarInput">Soubor s fotografií</label>
                                    <input class="avatar-input" id="avatarInput" name="avatar_file" type="file">
                                </div>

                                <!-- Crop and preview -->
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="avatar-wrapper"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="avatar-preview preview-lg"></div>
                                        <div class="avatar-preview preview-md"></div>
                                        <div class="avatar-preview preview-sm"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-default" type="button" data-dismiss="modal">Zavřít</button>
                            <button class="btn btn-primary avatar-save" type="submit">Uložit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.modal -->

        <!-- Loading state -->
        <div class="loading" tabindex="-1" role="img" aria-label="Loading"></div>

    </div><!-- /#crop-avatar -->

    {{ Form::open(['url' => 'user/profile']) }}
        {{ Form::bsText('phone', 'Telefon') }}
        {{ Form::bsSelect('faculty', 'Fakulta', ['FJFI']) }}

        <div class="form-group row">
            <div class="col-sm-6 left">
                {{ Form::label('sex', 'Jsi', ['class' => 'control-label']) }}
                {{ Form::select('sex', ['male' => 'Muž', 'female' => 'Žena'], null, ['placeholder' => 'Vyber pohlaví...', 'class' => 'form-control']) }}
            </div>
            <div class="col-sm-6 right">
                {{ Form::label('year', 'Rok narozeni', ['class' => 'control-label']) }}
                {{ Form::number('year', null, ['class' => 'form-control']) }}
            </div>
            <div class="col-sm-6 info"></div>
        </div>

        {{ Form::bsTextarea('about', 'O Tobě') }}
        {{ Form::bsSubmit('Aktualizovat profil') }}

    {{ Form::close() }}


    <div class="footer row">
        <div class="col-sm-12">
            <p>V případě technických potíží nás kontaktuj na <a href="mailto:buddy@isc.cvut.cz">buddy@isc.cvut.cz</a></p>
            <p>&copy; 2017 | International Student Club CTU in Prague, o.s.</p>
        </div>
    </div>

    @section('scripts')
        @parent
        <script src="{{ URL::asset('js/cropper.min.js') }}"></script>
        <script src="{{ URL::asset('js/crop-avatar.js') }}"></script>
    @stop
@stop