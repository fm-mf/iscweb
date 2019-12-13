<h2>
    <a href="{{ $newsletter->link }}" target="_blank" rel="noopener">
        {{ $newsletter->title }}
    </a>
</h2>
<p><small>{{ $newsletter->dateSentFormatted }}</small></p>
<p>{{ $newsletter->perex }}</p>
@can('acl', 'alumniNewsletter.update')
    <a class="btn btn-primary" href="{{ route('alumni.newsletters.edit', $newsletter) }}"><span class="fas fa-pen"></span> Upravit</a>
@endcan
@can('acl', 'alumniNewsletter.delete')
    <form class="delete" method="POST" action="{{ route('alumni.newsletters.destroy', ['newsletter' => $newsletter]) }}">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button type="submit" class="btn btn-danger"><span class="fas fa-trash-alt"></span> Smazat</button>
    </form>
@endcan
