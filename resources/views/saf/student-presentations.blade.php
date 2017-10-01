<section id="student-presentations">
    <h2>Studentské přednášky</h2>
    <div id="student-presentations-carousel">
        @for ($i = 0; $i < 19; $i++)
            <div id="p-{{ ($i + 1) }}" class="carousel-item"><a href="{{ $presentationsFbUrl[$i] }}" target="_blank"></a></div>
        @endfor
    </div>
</section>