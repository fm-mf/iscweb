<li class="row">
    <div class="col-3 col-md-2">
        <a href="{{ route('tandem.profile', ['tandemUser' => $tandemUser->hash_id]) }}">
            {{ $tandemUser->first_name }}
        </a>
    </div>
    <div class="col">
        {{ implode(', ', $tandemUser->languagesToTeach->pluck('language')->all()) }}
    </div>
    <div class="col">
        {{ implode(', ', $tandemUser->languagesToLearn->pluck('language')->all()) }}
    </div>
</li>
