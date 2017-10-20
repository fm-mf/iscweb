<section id="student-presentations">
    <h2>Studentské přednášky</h2>
    <div id="student-presentations-carousel">
        @for ($i = 0; $i < 19; $i++)
            <div id="p-{{ ($i + 1) }}" class="carousel-item"><a href="{{ $presentationsFbUrl[$i] }}" target="_blank"></a></div>
        @endfor
    </div> {{--
    <div id="student-presentations-calendar">
        <dl>
            @foreach ($presentations as $presentation_date => $presentation_descs)
                <dt>{{ $presentation_date }}</dt>
                @foreach($presentation_descs as $presentation_desc)
                    <dd>{{ $presentation_desc }}</dd>
                @endforeach
            @endforeach
        </dl>
    </div> --}}
</section>