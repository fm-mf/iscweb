<?php

namespace App\Http\Controllers\Saf;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SafController extends Controller
{
    public function showIndex()
    {
        return view('saf.index')->with([
                'presentations' => SafController::getPresentations(),
        ]);
    }

    private static function getPresentations()
    {
        return array(
                array(
                        'img' => 'img/web/contacts/2017spring/IT_Speedy.jpg',
                        'title' => 'Titulek prezentace',
                        'description' => 'Nějaký hodně dlouhý popisek prezentace. Bude to asi hodně zajímavé. Určitě se přijďte podívat.',
                ),
                array(
                        'img' => 'img/web/contacts/2017spring/IT_Speedy.jpg',
                        'title' => 'Titulek prezentace',
                        'description' => 'Nějaký hodně dlouhý popisek prezentace. Bude to asi hodně zajímavé. Určitě se přijďte podívat.',
                ),
                array(
                        'img' => 'img/web/contacts/2017spring/IT_Speedy.jpg',
                        'title' => 'Titulek prezentace',
                        'description' => 'Nějaký hodně dlouhý popisek prezentace. Bude to asi hodně zajímavé. Určitě se přijďte podívat.',
                ),
                array(
                        'img' => 'img/web/contacts/2017spring/IT_Speedy.jpg',
                        'title' => 'Titulek prezentace',
                        'description' => 'Nějaký hodně dlouhý popisek prezentace. Bude to asi hodně zajímavé. Určitě se přijďte podívat.',
                ),
                array(
                        'img' => 'img/web/contacts/2017spring/IT_Speedy.jpg',
                        'title' => 'Titulek prezentace',
                        'description' => 'Nějaký hodně dlouhý popisek prezentace. Bude to asi hodně zajímavé. Určitě se přijďte podívat.',
                ),
                array(
                        'img' => 'img/web/contacts/2017spring/IT_Speedy.jpg',
                        'title' => 'Titulek prezentace',
                        'description' => 'Nějaký hodně dlouhý popisek prezentace. Bude to asi hodně zajímavé. Určitě se přijďte podívat.',
                ),
        );
    }
}
