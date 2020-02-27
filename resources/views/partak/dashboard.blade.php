@extends('partak.layout.hp')

@section('subpage')

    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <p>Ahoj Parťáku! Následující stránka shrnuje na jednom místě ty nejdůležitější informace pro každého, kdo se chce do ISC aktivněji zapojit. Podrobnější informace pak najdeš v naší <a href="{{ url('/wiki') }}">wiki</a>. Pro přihlášení použij uživatelské jméno <strong>User</strong> a heslo <strong>Vzdy*VIS*viC</strong>.</p>

                <h2>Co se děje v ISC?</h2>
                <ul class="list-unstyled list-colored">
                    <li>
                        <p>Podívejte se, co se událo v ISC: <a href="{{ url('/blog') }}">ISC blog</a></p>
                    </li>

                    <li>
                        <p><h3><strong>Plníme ISC DokuWiki!</strong></h3></p>
                        <p>Naše DokuWiki pomalu začíná ožívat. Podívej se na <a href="{{ url('/wiki') }}">{{ url('/wiki') }}</a> a připiš co tam ještě není. Heslo je Vzdy*VIS*viC</p>
                    </li>

                </ul>

                <h2>Core Values</h2>
                <p>Kultura ISC stojí na jistých hodnotách od kterých se odvíjí to jak spolupracujeme, komunikujeme a jak se k sobě chováme. Tady je seznam těch nejdůležitějších hodnot, kterými se snažíme řídit:</p>
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

                <h2>Asana</h2>
                <p>Asana je nástroj pro teamovou (a meziteamovou) komunikaci - v zásadě se jedná o sdílený todo list. Jestli do této aplikace zatím nemáš přístup, popros koordinátora některého teamku, aby tě do naší skupiny pozval.</p>
                <p>Tady je krátký obrázkový návod, jak aplikaci používat. Detailnější příručka je na <a href="http://asana.com/guide">http://asana.com/guide</a></p>

                <img src="{{ URL::asset('img/partak/asana-guide.jpg') }}" id="asana-img">                
            </div>
            <div class="col-sm-4">
                <h2>Důležité odkazy</h2>
                <ul class="list-unstyled list-colored">
                    <li><a href="{{ url('/wiki') }}">DokuWiki</a>
                        <p>Studnice všech vědomostí o projektech a aktivitách.</p><p><strong>Login: User</strong></p><p><strong>Heslo: Vzdy*VIS*viC</strong></p>
                    </li>
                    <li><a href="https://www.google.com/calendar/embed?src=bnn2dkobab8l6p4n6jtot9gmd8%40group.calendar.google.com&ctz=Europe/Prague">Vnitřní kalendář</a>
                        <p>Kalendář všech pro ISC důležitých událostí</p>
                    </li>
                    <li>
                        <a href="{{ route('nas') }}">Fotogalerie (NAS)</a>
                        <p>Naleznete zde spoustu nových i starých fotek z akcí ISC</p>
                        <p><strong>Login: partak</strong></p><p><strong>Heslo: Quentinamakazdyrad</strong></p>
                    </li>
                    <li>
                        <a href="https://drive.google.com/folderview?id=0B7kiw4knduMXOWxRcjhZZGR5Nm8&usp=sharing">Podklady a materiály ISC</a>
                        <p>Loga, šablony, obrázky ISC</p>
                    </li>
                    <li>
                        <a href="https://drive.google.com/folderview?id=0B2sebxB3kcgYfnNyd3J2U28xMWtXdHVDQVFhZGJyZGQyU1hWcmttNS1FWnNSZzJOUm5HZGc&usp=drive_web">Podklady a materiály ESN</a>
                        <p>Aktuální loga, šablony ESN</p>
                    </li>
                    {{--<li>
                        <a href="https://drive.google.com/drive/folders/0B6FVYAfC-ldzOU9vUC1ZS050cTA?usp=sharing">ISC tiskoviny</a>
                        <p>Zde nejdete všechna čísla ISC zpravodaje a Diary of ISC (DISC)</p>
                    </li>--}}
                    <li>
                        <a href="{{ asset('/files/iscCtuSpiritBook.pdf') }}" alt="Download PDF version of ISC Spirit Book">ISC Spirit Book [PDF]</a>
                        <p>Elektronická verze ISC Spirit Book</p>
                    </li>
                </ul>

                <h2>Share your ideas</h2>
                <p>Máš nějaký nápad? Chceš posunout ISC ještě dále? Nelíbí se ti něco? Dej nám o tom vědět! Buď osobně nebo můžeš napsat
                    na <a href="mailto:ideas@isc.cvut.cz">ideas@isc.cvut.cz</a></p>

                <h2>Použávání štítků (tagů)</h2>
                <p>Na FB skupině, asaně i v mailech všichni často používáme štítky. Rozhodli jsme se proto sjednoti pravidla jejich používání.</p>
                <ul>
                    <li>BEZ MEZER, používat jen (pomlčka '-', podtržítko '_', tečka '.')</li>
                    <li>ideálně malá písmena</li>
                    <li>bez diakritiky</li>
                    <li>slova v jednodušším tvaru (upřednostňujeme angličtinu)</li>
                </ul>

                <h3>Příklady používaných štítků</h3>
                <p><strong>Obecné</strong>: urgent, workshop, idea, housing, trip,</p>
                <p><strong>ISC</strong>: BW, PW, SAF, PR, HR, languages, languageCourses, salsa, movieNight, tandem</p>
            </div>
        </div>


    </div>

@endsection
