<section id="partners">
    <h2>Partneři</h2>
    <ul>
        @foreach($partners as $partner)
            <li>
                <img src="{{ asset($partner['img']) }}" />
                <h3>{{ $partner['title'] }}</h3>
                <p>{{ $partner['description'] }}</p>
            </li>
        @endforeach
    </ul>
</section>