@extends('partak.layout.hp')

@section('subpage')

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <p>Ahoj Parťáku! Následující stránka shrnuje na jednom místě ty nejdůležitější informace pro každého, kdo se chce do ESN aktivněji zapojit. Podrobnější informace pak najdeš v naší <a href="https://esnctu.notion.site/68b32fcf9ad24350a81c354e076dc747?v=c0009ed9bdb04a08b7b9d0f881b2dfef&pvs=4">wiki</a>. Pro přihlášení použij přihlašovací údaje do parťák netu.</p>

                <h2>Co se děje v ESN?</h2>

                <div id="rss-feed"></div>

                <ul class="list-unstyled list-colored">
                    <li>
                        <p><h3><strong>Plníme ESN CTU Wiki!</strong></h3></p>
                        <p>Naše Wiki (Notion) pomalu začíná ožívat. Podívej se na <a href="https://esnctu.notion.site/68b32fcf9ad24350a81c354e076dc747?v=c0009ed9bdb04a08b7b9d0f881b2dfef&pvs=4">notion.com</a> a připiš co tam ještě není.</p>
                    </li>

                </ul>

                <h2>Core Values</h2>
                <p>Kultura ESN CTU stojí na jistých hodnotách, od kterých se odvíjí to, jak spolupracujeme, komunikujeme a jak se k sobě chováme. Tady je seznam těch nejdůležitějších hodnot, kterými se snažíme řídit:</p>
                <ol class="list-colored">
                    <li>Share your ideas.</li>
                    <li>Be active, Creative and open-minded.</li>
                    <li>Give and ask for feedback.</li>
                    <li>Get involved and involve others.</li>
                    <li>Pursue growth of yourself and help others grow with you.</li>
                    <li>Stay optimistic.</li>
                    <li>Never worry about making mistakes, but be sure to learn from them</li>
                    <li>Be humble</li>
                    <li>Expand your horizons</li>
                    <li><strong>Believe in ISC Spirit. Pass it on.</strong></li>
                </ol>

{{--                <h2>Asana</h2>--}}
{{--                <p>Asana je nástroj pro teamovou (a meziteamovou) komunikaci - v zásadě se jedná o sdílený todo list. Jestli do této aplikace zatím nemáš přístup, popros koordinátora některého teamku, aby tě do naší skupiny pozval.</p>--}}
{{--                <p>Tady je krátký obrázkový návod, jak aplikaci používat. Detailnější příručka je na <a href="http://asana.com/guide">http://asana.com/guide</a></p>--}}

{{--                <picture class="d-block">--}}
{{--                    <source type="image/webp" srcset="{{ asset('img/partak/asana-guide.webp') }}" />--}}
{{--                    <img src="{{ asset('img/partak/asana-guide.jpg') }}" id="asana-img" alt="Asana quick guide" />--}}
{{--                </picture>--}}
            </div>
            <div class="col-md-4">
                <h2>Důležité odkazy</h2>
                <ul class="list-unstyled list-colored">
                    <li>
                        <a href="https://chat.whatsapp.com/I9EItujnwj1GSoYpKGWNpD" target="_blank" >
                            WhatsApp komunita
                        </a>
                        <p>Hlavní komunikační platforma pro aktivní členy</p>
                    </li>
                    <li><a href="https://esnctu.notion.site/68b32fcf9ad24350a81c354e076dc747?v=c0009ed9bdb04a08b7b9d0f881b2dfef&pvs=4">Wiki (Notion)</a>
                        <p>Studnice všech vědomostí o projektech a aktivitách.</p>
                    </li>

                    <li><a href="https://www.google.com/calendar/embed?src=bnn2dkobab8l6p4n6jtot9gmd8%40group.calendar.google.com&ctz=Europe/Prague">Vnitřní kalendář</a>
                        <p>Kalendář všech pro ESN CTU důležitých událostí</p>
                    </li>
                    <li>
                        <a href="{{ route('nas') }}">Fotogalerie (NAS)</a>
                        <p>Naleznete zde spoustu nových i starých fotek z akcí ESN</p>
                        <p><strong>Login: partak</strong></p><p><strong>Heslo: Quentinamakazdyrad</strong></p>
                    </li>
                    <li>
                        <a href="https://drive.google.com/folderview?id=0B7kiw4knduMXOWxRcjhZZGR5Nm8&usp=sharing">Podklady a materiály ESN CTU</a>
                        <p>Loga, šablony, obrázky ESN CTU</p>
                    </li>
                    <li>
                        <a href="https://drive.google.com/folderview?id=0B2sebxB3kcgYfnNyd3J2U28xMWtXdHVDQVFhZGJyZGQyU1hWcmttNS1FWnNSZzJOUm5HZGc&usp=drive_web">Podklady a materiály ESN</a>
                        <p>Aktuální loga, šablony ESN</p>
                    </li>
                    {{--<li>
                        <a href="https://drive.google.com/drive/folders/0B6FVYAfC-ldzOU9vUC1ZS050cTA?usp=sharing">ESN tiskoviny</a>
                        <p>Zde nejdete všechna čísla ESN zpravodaje a Diary of ESN (DISC)</p>
                    </li>--}}
                    <li>
                        <a href="{{ asset('/files/iscCtuSpiritBook.pdf') }}" alt="Download PDF version of ISC Spirit Book">ISC Spirit Book [PDF]</a>
                        <p>Elektronická verze ISC Spirit Book</p>
                    </li>
                    <li>
                        <a href="https://forms.gle/iZn18JujtLD7QmdA8" target="_blank" rel="noreferrer">
                            Anonymní zpětná vazba
                        </a>
                        <p>
                            Chceš vyjádřit svůj názor? Chceš aby se v ESN něco změnilo?
                            Vadí ti něco v ESN ale nechceš to říct veřejně? Nebo bys chtěl něco pochválit?
                            Pak je tento formulář přesně pro tebe.
                        </p>
                    </li>
                </ul>

                <h2>Share your ideas</h2>
                <p>Máš nějaký nápad? Chceš posunout ESN ještě dále? Nelíbí se ti něco? Dej nám o tom vědět! Buď osobně nebo můžeš napsat
                    na <a href="mailto:ideas@esn.cvut.cz">ideas@esn.cvut.cz</a></p>

{{--                <h2>Používání štítků (tagů)</h2>--}}
{{--                <p>Na FB skupině, asaně i v mailech všichni často používáme štítky. Rozhodli jsme se proto sjednoti pravidla jejich používání.</p>--}}
{{--                <ul>--}}
{{--                    <li>BEZ MEZER, používat jen (pomlčka '-', podtržítko '_', tečka '.')</li>--}}
{{--                    <li>ideálně malá písmena</li>--}}
{{--                    <li>bez diakritiky</li>--}}
{{--                    <li>slova v jednodušším tvaru (upřednostňujeme angličtinu)</li>--}}
{{--                </ul>--}}

{{--                <h3>Příklady používaných štítků</h3>--}}
{{--                <p><strong>Obecné</strong>: urgent, workshop, idea, housing, trip,</p>--}}
{{--                <p><strong>ESN</strong>: BW, PW, SAF, PR, HR, languages, languageCourses, salsa, movieNight, tandem</p>--}}
            </div>
        </div>


    </div>

@endsection

@section('scripts')
    @parent

    <script src="{{ mix('/js/blog-rss-feed.js') }}" defer="defer"></script>
@endsection
