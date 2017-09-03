<section id="presentations">
    <h2>Přednášky na fakultách</h2>
    <ul>
        @foreach($presentations as $presentation)
            <li>
                <img src="{{ asset('img/web/contacts/2017spring/' . $presentation['img']) }}" />
                <h3>{{ $presentation['title'] }}</h3>
                <p>{{ $presentation['description'] }}</p>
            </li>
        @endforeach
    </ul>
</section>