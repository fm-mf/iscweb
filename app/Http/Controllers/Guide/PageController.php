<?php

namespace App\Http\Controllers\Guide;

use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Settings\Facade as Settings;
use App\Models\ExchangeStudent;

class PageController extends Controller
{

    public function showPage($page = "")
    {
        $with = [];
        switch ($page){
            case "about-CTU":
                $with = ['rector' => Settings::get('rector')];
                break;
            case "":
                $with = ['president' => Settings::get('president'),
                        'presidentPicture' => Settings::get('presidentPicture'),
                        'studentsCount' => ExchangeStudent::byUniqueSemester(Settings::get('currentSemester'))->count()];
                $page = "home";
                break;
            case "basic-information":
                $with = ['wcFrom' => Settings::get('wcFrom'),
                            'owFrom' => Settings::get('owFrom'),
                            'owFromTo' => Settings::get('owFromTo')];
                break;
            case "orientation-week":
                $with = ['owFromTo' => Settings::get('owFromTo')];
                break;
        }
        return view('guide.' . $page)->with($with);


    }
}
