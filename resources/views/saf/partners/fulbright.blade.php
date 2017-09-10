@extends('layouts.saf.partner-subpage')

@section('title', 'Fulbrightova komise &ndash; ')

@section('page')
    @parent

    <section>
        <div>
            <img src="{{ asset('img/saf/partners/logo-fulbright-horizontal.gif') }}" alt="Logo Fulbrightovy komise" title="Logo Fulbrightovy komise" class="logo" />
        </div>
        <h1>Fulbrightova komise</h1>
        <p>Prestižní Fulbrightovy stipendijní programy financované českou a americkou vládou a administrované Komisí
            J. Williama Fulbrighta poskytují českým postgraduálním studentům, akademikům a vědcům příležitost studovat,
            provádět výzkum či vyučovat na amerických univerzitách.</p>
        <p>Stipendia Fulbrightova programu patří mezi nejštědřejší, obvykle pokrývají životní náklady,
            zpáteční letenku a zdravotní pojištění a případně i některé další náklady spojené se studiem či výzkumem.</p>
        <p>Program podporuje všechny obory s výjimkou studia klinické medicíny, MBA a LLM.
            Stipendisté jsou vybíráni v otevřené soutěži. Zájemci se o podporu uchází přímo u Fulbrightovy komise,
            nikoliv přes své domovské instituce.</p>
        <p>Každoročně s Fulbrightem do USA v rámci různých stipendijních kategorií vycestuje až 40 českých „fulbrightistů“.
            Poměr vybraných stipendistů k počtu přihlášek se pohybuje mezi jedna ku třem a jedna ku pěti.</p>
    </section>

    <section>
        <h2>Semináře o studiu v USA</h2>
        <p>Zájemcům o vysokoškolské studium v USA nabízí poradenské centrum Fulbrightovy komise sérii bezplatných seminářů.</p>
        <ul>
            <li>14. 9. &ndash; Jak na vysokou školu do USA</li>
            <li>12. 10. &ndash; Jak na americké přijímací zkoušky</li>
            <li>26. 10. &ndash; Jak financovat studium v USA</li>
            <li>16. 11. &ndash; Jak na eseje pro americké přijímací řízení</li>
            <li>23. 11. &ndash; Jak připravit kvalitní přihlášku na americké univerzity</li>
        </ul>
        <p>Více informací na <a href="http://www.fulbright.cz/akce" target="_blank">www.fulbright.cz/akce</a>.</p>
    </section>
@endsection