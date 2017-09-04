<section id="partners">
    <h2>Partneři</h2>
    <ul>
        @foreach ($partners as $partner)
            @if ($partner['title'] !== '' && $partner['description'] !== '')
            <li>
                @if ($partner['url'] !== '')
                <a href="{{ url('scvutdosveta/'. $partner['url']) }}">
                @endif
                    <img src="{{ asset('img/saf/partners/' . $partner['img']) }}" />
                    <h3>{{ $partner['title'] }}</h3>
                    <p>{{ $partner['description'] }}</p>
                @if ($partner['url'] !== '')
                </a>
                @endif
            </li>
            @endif
        @endforeach
    </ul>
</section>