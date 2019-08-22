@extends('czech.layouts.layout')
@section('title', 'Často kladené otázky')
@section('page')
    <section class="faq">
        <div class="container">
            <div class="row">
                <div class="col col-lg-10 mx-lg-auto">
                    <h1>Často kladené otázky</h1>
                    <dl>
                        <dt>Jak se stát Buddym?</dt>
                        <dd>
                            Stačí se <a href="{{ route('register') }}">zaregistrovat</a>
                            do našeho Buddy programu. Až bude čas otevření databáze
                            se zahraničními studenty, obdržíš od nás e-mail s informacemi
                            a budeš si moct vybrat svého zahraňáka.
                        </dd>

                        <dt>Můžu mít zahraňáka, i když moje angličtina není moc dobrá?</dt>
                        <dd>
                            Bez obav! Být součástí Buddy Programu je skvělá příležitost,
                            jak si zlepšit cizí jazyk. Tak neváhej a
                            <a href="{{ route('register') }}">zaregistruj se</a>.
                        </dd>

                        <dt>Kolik si můžu vybrat zahraničních studentů?</dt>
                        <dd>
                            Každý den si můžeš vybrat 1 zahraňáka. Kolik jich budeš nakonec mít je pouze na tobě.
                        </dd>

                        <dt>Jak bude probíhat Orientation week?</dt>
                        <dd>
                            Podrobný program Orientation weeku najdou zahraňáci na jak našem webu v sekci
                            <a href="{{ route('guide-page', ['page' => 'orientation-week']) }}">Survival guide</a>
                            tak na naší <a href="{{ $linkOwFbEvent }}" target="_blank" rel="noopener">FB události</a>
                            a ve <a href="{{ $linkExchangeGroup }}">speciální FB skupině</a>,
                            kterou pro ně každý semestr zakládáme. Můžeš taky svému zahraňákovi připomenout,
                            aby se do téhle skupiny přidal. Samozřejmě se můžeš přidat i ty sám,
                            pokud si přeješ sledovat všechny aktuální informace a události.
                        </dd>
                        <dd>
                            V pondělí čeká zahraňáky slavnostní uvítání a prezentace se všemi důležitými informacemi.
                            Večer pak můžete společně dorazit na Tandem evening.
                        </dd>
                        <dd>
                            V úterý a středu dopoledne budou registrace na fakultách organizované ISC,
                            nemusíš tedy zahraňáka doprovázet, jen se ujisti, že už má svůj Welcome pack.
                            Středa odpoledne bude věnovaná Prague discovery game, které se můžeš zúčastnit
                            v roli organizátora, a výsledky hry budou vyhlášené večer na inteGREATion party.
                        </dd>
                        <dd>
                            Od čtvrtka do neděle pořádáme výlety po České republice – i tady se můžeš zapojit jako spoluorganizátor.
                        </dd>

                        <dt>Co je to Welcome pack?</dt>
                        <dd>
                            Welcome pack je obálka pro každého studenta přijíždějícího na program ERASMUS+
                            nebo Bilaterální dohodu. Obsahuje informační letáčky, Survival guide,
                            žádost o vystavení tramvajenky atd.
                        </dd>

                        <dt>Kde a kdy můžu Welcome pack vyzvednout a musí u toho být i zahraňák?</dt>
                        <dd>
                            Welcome packy je možné vyzvednout v <a href="{{ route('czech.contacts') }}">ISC Pointu</a>
                            většinou od středy týden před začátkem Orientation weeku. Pro přesné datum sleduj aktuality
                            na naší <a href="https://www.facebook.com/isc.ctu.prague" target="_blank" rel="noopener">FB stránce</a>
                            a v <a href="https://www.facebook.com/groups/isc.ctu.buddies" target="_blank" rel="noopener">Buddy skupině</a>.
                            Welcome pack si můžeš vyzvednout pro svého zahraňáka i ty ještě před jeho příjezdem,
                            nebo pro něj můžete zajít společně cestou z letiště.
                        </dd>

                        <dt>Jak se mohu více zapojit do ISC?</dt>
                        <dd>
                            Napiš nám na <a href="mailto:hr@isc.cvut.cz">hr@isc.cvut.cz</a>
                            nebo se rovnou stav do našeho <a href="{{ route('czech.contacts') }}">ISC Pointu</a>.
                            Každého aktivního studenta vítáme a možností zapojení je celá řada.
                            Taky si můžeš projít naše stránky a uvidíš, co vše děláme.
                        </dd>

                        <dt>Kde se dozvím aktuální informace o dění v ISC?</dt>
                        <dd>
                            Informace najdeš tady na webu v záložce kalendáře. Také nás můžeš sledovat na
                            <a href="https://www.facebook.com/isc.ctu.prague" target="_blank" rel="noopener">Facebooku</a>
                            a přidat se do naší <a href="https://www.facebook.com/groups/isc.ctu.buddies" target="_blank" rel="noopener">skupiny pro české Buddíky</a>.
                        </dd>

                        <dt>Kde můžu získat ESN kartičku, pokud odjíždím na Erasmus a na mé univerzitě není sekce ESN?</dt>
                        <dd>
                            Pokud tvoje přijímající univerzita nemá místní sekci, můžeš kontaktovat
                            některou další sekci ve stejném městě. ESN kartička tě většinou opravňuje k tomu,
                            aby ses účastnil aktivit sekcí pořádaných. Máš další otázky?
                            Napiš nám e-mail na <a href="mailto:isc@isc.cvut.cz">isc@isc.cvut.cz</a>.
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </section>
@endsection
