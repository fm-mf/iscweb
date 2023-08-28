@php
    $formIdCzech = 'c2edVv';
    $formIdEnglish = 'ghFtdC9m';
    $formId = app()->getLocale() === 'cs' ? $formIdCzech : $formIdEnglish;
@endphp

<!-- Typeform -->
<div data-tf-widget="{{ $formId }}"  data-tf-opacity="75" data-tf-disable-scroll data-tf-auto-resize id="form" class="typeform-widget" style="min-height: 55ex"></div>

@section('scripts')
    @parent
    <script src="https://embed.typeform.com/next/embed.js" defer="defer"></script>
@endsection
<!-- /Typeform -->
