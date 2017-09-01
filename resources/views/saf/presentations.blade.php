<section id="presentations">
    <h2>Přednášky na fakultách</h2>
    <ul>
        @foreach($presentations as $presentation)
            <li>
                <img src="{{ asset($presentation['img']) }}" />
                <h3>{{ $presentation['title'] }}</h3>
                <p>{{ $presentation['description'] }}</p>
            </li>
        @endforeach
    </ul>
</section>