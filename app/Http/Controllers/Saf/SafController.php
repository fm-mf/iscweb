<?php

namespace App\Http\Controllers\Saf;

use App\Http\Controllers\Controller;
use App\Settings\Facade as Settings;
use Carbon\Carbon;

class SafController extends Controller
{
    public function showIndex()
    {
        $with = ['shortName' => Settings::get('shortName'),
            'officialName' => Settings::get('officialName'),
            'year' => Carbon::now()->year,
            'presentations' => SafController::getPresentations(),
            'partners' => SafController::getPartners(),];
        return view('saf.index')->with($with);
    }

    public function showPartner($partnerUrl) {
        $with = ['shortName' => Settings::get('shortName'),
            'officialName' => Settings::get('officialName'),
            'year' => Carbon::now()->year,];
        return view('saf.partners.' . $partnerUrl)->with($with);
    }

    private static function getPresentations()
    {
        return array(
                array(
                        'img' => 'IT_Speedy.jpg',
                        'title' => 'Titulek prezentace',
                        'description' => 'Nějaký hodně dlouhý popisek prezentace. Bude to asi hodně zajímavé. Určitě se přijďte podívat.',
                ),
                array(
                        'img' => 'IT_Speedy.jpg',
                        'title' => 'Titulek prezentace',
                        'description' => 'Nějaký hodně dlouhý popisek prezentace. Bude to asi hodně zajímavé. Určitě se přijďte podívat.',
                ),
                array(
                        'img' => 'IT_Speedy.jpg',
                        'title' => 'Titulek prezentace',
                        'description' => 'Nějaký hodně dlouhý popisek prezentace. Bude to asi hodně zajímavé. Určitě se přijďte podívat.',
                ),
                array(
                        'img' => 'IT_Speedy.jpg',
                        'title' => 'Titulek prezentace',
                        'description' => 'Nějaký hodně dlouhý popisek prezentace. Bude to asi hodně zajímavé. Určitě se přijďte podívat.',
                ),
                array(
                        'img' => 'IT_Speedy.jpg',
                        'title' => 'Titulek prezentace',
                        'description' => 'Nějaký hodně dlouhý popisek prezentace. Bude to asi hodně zajímavé. Určitě se přijďte podívat.',
                ),
                array(
                        'img' => 'IT_Speedy.jpg',
                        'title' => 'Titulek prezentace',
                        'description' => 'Nějaký hodně dlouhý popisek prezentace. Bude to asi hodně zajímavé. Určitě se přijďte podívat.',
                ),
        );
    }

    private static function getPartners()
    {
        return array(
                array(
                        'img' => '',
                        'title' => '',
                        'description' => '',
                        'url' => '',
                ),
                array(
                        'img' => 'logo-fulbright-vertical.gif',
                        'title' => 'Fulbrightova komise',
                        'description' => 'Prestižní Fulbrightovy stipendijní programy financované českou a americkou vládou a administrované Komisí J. Williama Fulbrighta poskytují příležitost studovat, provádět výzkum či vyučovat na amerických univerzitách.',
                        'url' => 'fulbright',
                ),
                array(
                        'img' => 'logo-bakala-foundation.png',
                        'title' => 'Bakala Foundation',
                        'description' => 'Bakala Foundation je česká nadace Zdeňka a Michaely Bakalových. Byla založena v roce 2007 s cílem podporovat studium talentovaných studentů na prestižních zahraničních univerzitách prostřednictvím programu Scholarship.',
                        'url' => 'bakala-foundation',
                ),
                array(
                        'img' => 'logo-campus-france.png',
                        'title' => 'Campus France',
                        'description' => 'Espace Campus France Česká republika (ECF) sídlí ve Francouzském institutu a nabízí informační službu českým studentům, kteří chtějí začít nebo pokračovat ve studiích ve Francii.',
                        'url' => 'campus-france',
                ),
                array(
                        'img' => 'logo-japan-embassy.jpg',
                        'title' => 'Japan Embassy',
                        'description' => 'Japonské informační a kulturní centrum (JICC) je součástí Velvyslanectví Japonska v ČR.',
                        'url' => 'japan-embassy',
                ),
                array(
                        'img' => '',
                        'title' => '',
                        'description' => '',
                        'url' => '',
                ),
                array(
                        'img' => 'logo-study-cz.png',
                        'title' => 'Study.cz',
                        'description' => 'Portál Study.cz provozuje společnost ASIANA spol. s r. o., která byla založena v roce 1993 a jako první v ČR odbavovala studenty za studiem nejen do evropských škol, ale i do daleké Austrálie.',
                        'url' => 'study-cz',
                ),
                array(
                        'img' => 'logo-aiesec.png',
                        'title' => 'AIESEC',
                        'description' => '',
                        'url' => 'aiesec',
                ),
                array(
                        'img' => '',
                        'title' => '',
                        'description' => '',
                        'url' => '',
                ),
                array(
                        'img' => 'logo-best.png',
                        'title' => 'BEST',
                        'description' => 'BEST, Board of European Students of Technology, je neustále se rozšiřující, nezisková, nepolitická organizace. Od roku 1989 podporuje studenty z celé Evropy ve vzájemné komunikaci, spolupráci a výměně zkušeností.',
                        'url' => 'best',
                ),
                array(
                        'img' => 'logo-iaeste-vertical.png',
                        'title' => 'IAESTE',
                        'description' => 'IAESTE je mezinárodní, nevládní, nepolitická a nezisková organizace, která sdružuje mladé lidi bez ohledu na náboženství, národnost, barvu pleti, původu nebo pohlaví.',
                        'url' => 'iaeste',
                ),
        );
    }
}
