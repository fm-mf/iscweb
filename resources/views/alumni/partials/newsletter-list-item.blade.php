<h2>
    <a href="{{ $newsletter->link }}" target="_blank" rel="noopener">
        {{ $newsletter->title }}
    </a>
</h2>
<p><small>{{ $newsletter->dateSentFormatted }}</small></p>
<p>{{ $newsletter->perex }}</p>

{{ $actionButtons }}
