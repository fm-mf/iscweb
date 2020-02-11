<meta name="csrf-token" content="{{ csrf_token() }}" />

<div class="row crop-avatar" id="crop-avatar">
    <!-- Current avatar -->
    <div class="col-sm-4">
        <div class="avatar-view avatar-edit" title="Change the avatar">
            <img src="{{ asset($avatar) }}" alt="Avatar" id="avatar">
        </div>
    </div>
    <div class="col-sm-8">
        <label for="avatar">{{ trans('forms.profile-picture') }}</label>
        <p class="grey">{{ trans('forms.profile-picture-info') }}</p>
    </div>

    <!-- Cropping modal -->
    <div class="modal fade" id="avatar-modal" tabindex="-1" role="dialog" aria-labelledby="avatar-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form class="avatar-form" id="avatar-form" method="post" action="{{ url('api/avatar') }}" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" id="avatar-modal-label">{{ trans('forms.profile-picture-change') }}</h4>
                    </div>
                    <div class="modal-body">
                        <div class="avatar-body">
                            <!-- Upload image and data -->
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="alert alert-info">The file has to be smaller than 2 MB.</p>
                                </div>
                            </div>

                            <div class="row" id="file-too-big" style="display: none">
                                <div class="col-md-12">
                                    <p class="alert alert-danger">The selected file is too big!</p>
                                </div>
                            </div>

                            <div class="row avatar-upload form-group">
                                @if (isset($userHash))
                                <input type="hidden" name="hash" value="{{ $userHash }}">
                                @endif
                                <input class="avatar-src" name="avatar_src" type="hidden">
                                <input class="avatar-data" name="avatar_data" type="hidden">
                                <label for="avatarInput">{{ trans('forms.file-with-picture') }}</label>
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
                        <button class="btn btn-default" type="button" data-dismiss="modal"> {{ trans('forms.close') }}</button>
                        <button class="btn btn-primary avatar-save" type="submit">{{ trans('forms.save') }}</button>
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
