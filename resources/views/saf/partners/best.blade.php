@extends('layouts.saf.partner-subpage')

@section('title', 'BEST &ndash; ')

@section('page')
    @parent

    <section>
        <div>
            <img src="{{ asset('img/saf/partners/logo-best.png') }}" alt="Logo BEST" title="Logo BEST" class="logo" />
        </div>
        <h1>BEST</h1>
    </section>

    <section>
        <h2>Mezinárodní organizace BEST</h2>
        <p>BEST, Board of European Students of Technology, je neustále se rozšiřující, nezisková, nepolitická organizace.
            Od roku 1989 podporujeme studenty z celé Evropy ve vzájemné komunikaci, spolupráci a výměně zkušeností.</p>
        <p>Cílem BESTu je pomáhat studentům v porozumění jiných kultur, připravovat je na práci v mezinárodním prostředí
            a podporovat rozšiřování jejich odborných, komunikačních a prezentačních dovedností.</p>
        <p>Hlavní aktivity BESTu spočívají v organizaci doplňkově-vzdělávacích programů, jako například:</p>
        <dl>
            <dt>BEST kurzy</dt>
                <dd>Studenti ČVUT mohou díky BEST Prague vycestovat na 1–2 týdenní technicky zaměřené kurzy
                    s akademickým programem na některou z evropských univerzit za extrémně výhodných podmínek.</dd>
            <dt>Inženýrské soutěže</dt>
                <dd>Představují možnost aplikovat své teoretické znalosti při řešení reálných technických problémů v týmu.
                    Studenti se v průběhu soutěže mohou v příjemném prostředí setkat se zástupci firem
                    a dozvědět se více o dané problematice přímo z praxe.</dd>
        </dl>
    </section>

    <section>
        <h2>Lokální skupina BEST Prague</h2>
        <p>Pražská pobočka organizace BEST byla založena v roce 2009 studenty ČVUT. Všem studentům ČVUT,
            které baví cestovat, poznávat různé kultury a učit se poutavou formou, zprostředkováváme možnost
            zúčastnit se BEST kurzů, inženýrských soutěží, sympózií o vzdělávání a dalších BEST aktivit.</p>
        <p>BEST Prague funguje díky dobrovolné práci vysoce motivovaných, aktivních studentů se zájmem o seberealizaci
            v multikulturním prostředí. Členové BESTu Praha organizují mezinárodní vzdělávací akce akademické soutěže
            na půdě ČVUT ve spolupráci s univerzitou, průmyslem a dalšími partnerskými organizacemi,
            což jim dovoluje načerpat cenné praktické zkušenosti uplatnitelné v jejich budoucí kariéře.</p>
        <p>Další výhodou členství v BESTu Praha je možnost účastnit se interních akcí jako jsou např.
            kulturní výměny, motivační víkendy a soft-skills tréninky.</p>
    </section>
@endsection