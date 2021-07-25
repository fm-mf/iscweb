<div class="row crop-avatar" id="crop-avatar">
    <!-- Current avatar -->
    <div class="form-group col-12">
        <div class="avatar-view avatar-edit">
            <img src="{{ $avatar }}" alt="Avatar" id="avatar" title="Change the avatar">
        </div>
        <small class="form-text text-muted text-center">{{ trans('forms.profile-picture-help') }}</small>
    </div>

    <!-- Cropping modal -->
    <div class="modal fade" id="avatar-modal" data-backdrop="static" tabindex="-1" aria-labelledby="avatar-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form class="avatar-form" id="avatar-form" method="post" action="{{ url('api/avatar') }}" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title m-0" id="avatar-modal-label">
                            {{ trans('forms.profile-picture-change') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="alert alert-info" role="alert">
                            <i class="fas fa-info-circle fa-fw float-left"></i>
                            <strong class="d-block ml-4">
                                @lang('forms.file-info')
                            </strong>
                        </p>
                        <p class="alert alert-danger" id="file-too-big" role="alert" style="display: none">
                            <i class="fas fa-exclamation-triangle fa-fw float-left"></i>
                            <strong class="d-block ml-4">
                                @lang('forms.file-too-big')
                            </strong>
                        </p>

                        <!-- Upload image and data -->
                        <div class="form-group">
                            @isset($userHash)
                                <input type="hidden" name="hash" value="{{ $userHash }}">
                            @endisset
                            <input class="avatar-src" name="avatar_src" type="hidden">
                            <input class="avatar-data" name="avatar_data" type="hidden">
                            <div class="custom-file">
                                <input
                                    type="file"
                                    id="avatarInput"
                                    name="avatar_file"
                                    class="custom-file-input avatar-input"
                                    accept="image/*"
                                    required="required"
                                />
                                <label for="avatarInput" class="custom-file-label text-left">
                                    @lang('forms.profile-picture-input-label')
                                </label>
                            </div>
                        </div>

                        <div class="avatar-upload"></div>

                        <!-- Crop and preview -->
                        <div class="avatar-wrapper"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                            <i class="fas fa-times"></i> {{ trans('forms.close') }}
                        </button>
                        <button type="submit" class="btn btn-primary avatar-save">
                            <i class="fas fa-save"></i> {{ trans('forms.save') }}
                        </button>
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
    <link rel="stylesheet" type="text/css" href="{{ mix('css/avatar.css') }}" />
@endsection

@section('scripts')
    @parent
    <script src="{{ mix('js/crop-avatar.js') }}" defer="defer"></script>
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            customFileInputHandler();
        });

        function customFileInputHandler(event) {
            document.getElementById('avatarInput').addEventListener('change', onFileInputChange);
        }

        function onFileInputChange(event) {
            const label = event.target.labels[0];
            if (event.target.files.length === 0) {
                label.innerText = '@lang('forms.profile-picture-input-label')';
                return;
            }
            label.innerText = event.target.files[0].name;
        }
    </script>
@endsection
