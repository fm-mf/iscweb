<meta name="csrf-token" content="{{ csrf_token() }}" />

<div class="row crop-avatar" id="crop-avatar">
    <!-- Current avatar -->
    <div class="col-sm-4">
        <div class="avatar-view" title="Change the avatar">
            <img src="{{ asset($avatar) }}" alt="Avatar" id="avatar">
        </div>
    </div>
    <div class="col-sm-8">
        <label for="avatar">Profilová fotografie</label>
        <p class="grey" style="vertical-align: middle;">Pro změnu profilové fotky klikni na obrázek. Maximální povolená velikost souboru je 2MB</p>
    </div>


    <!-- Cropping modal -->
    <div class="modal fade" id="avatar-modal" tabindex="-1" role="dialog" aria-labelledby="avatar-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form class="avatar-form" id="avatar-form" method="post" action="{{ url('api/avatar') }}" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" id="avatar-modal-label">Změna profilové fotky</h4>
                    </div>
                    <div class="modal-body">
                        <div class="avatar-body">
                            <!-- Upload image and data -->
                            <div class="row avatar-upload form-group">
                                <input type="hidden" name="id" value="none">
                                <input class="avatar-src" name="avatar_src" type="hidden">
                                <input class="avatar-data" name="avatar_data" type="hidden">
                                <label for="avatarInput">Soubor s fotografií</label>
                                <input class="avatar-input" id="avatarInput" name="avatar_file" type="file">
                            </div>

                            <!-- Crop and preview -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="avatar-wrapper"></div>
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

@section('stylesheets')
    @parent
    <link  href="{{ URL::asset('css/cropper.css') }}" rel="stylesheet">
@stop

@section('scripts')
    @parent
    <script src="{{ URL::asset('js/cropper.js') }}"></script>
    <script src="{{ URL::asset('js/crop-avatar.js') }}"></script>
@stop