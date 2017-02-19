<?php

namespace App\Http\Controllers\Guide;

use Carbon\Carbon;
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
                $with = ['wcFrom' => $this->dateToCorrectFormat(Settings::get('wcFrom')),
                            'owFrom' => $this->dateToCorrectFormat(Settings::get('owFrom')),
                            'owFromTo' => $this->dateToCorrectFormat(Settings::get('owFrom'), Settings::get('owTo')),
                ];
                break;
            case "orientation-week":
                $with = ['owFromTo' => $this->dateToCorrectFormat(Settings::get('owFrom'), Settings::get('owTo'))];
                break;
        }
        return view('guide.' . $page)->with($with);
    }

    private function dateToCorrectFormat($from, $to = null)
    {
        $dateFrom = Carbon::createFromFormat('d/m/Y' ,$from);
        $result = '';
        if($to == null) $result = $dateFrom->format('l F jS');
        else
        {
            $dateTo = Carbon::createFromFormat('d/m/Y' ,$to);
            if($dateFrom->year == $dateTo->year)
            {
                if($dateFrom->month != $dateTo->month )
                {
                    $result = $dateFrom->format('F jS') .' - '. $dateTo->format('F jS, Y');
                }
                else
                {
                    $result = $dateFrom->format('F jS') .' - '. $dateTo->format('jS, Y');
                }
            }
            else
            {
                $result = $dateFrom->format('F jS Y') .' - '. $dateTo->format('F jS Y');
            }
        }
        return $result;
    }
}
