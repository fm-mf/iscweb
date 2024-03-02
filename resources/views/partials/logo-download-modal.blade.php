<div class="modal fade" id="logo-download">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
{{--                TODO get new watermark logo--}}
                <img src="{{ asset('img/logos/isc-logo-watermark-color.svg') }}" alt="ESN CTU Logo" />
                <h2>@lang('web.logo-download-modal.heading')</h2>
                <p>@lang('web.logo-download-modal.description')</p>
                <a class="btn btn-success" href="{{ asset('files/isc-logos-2019.zip') }}">@lang('web.logo-download-modal.link')</a>
            </div>
        </div>
    </div>
</div>
