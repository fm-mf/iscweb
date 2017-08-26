<?php

namespace App\Http\Controllers\Guide;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Settings\Facade as Settings;
use App\Models\ExchangeStudent;

class PageController extends Controller
{

    public function showPage($page = "")
    {
        $with = ['shortName' => Settings::get('shortName'),
                'officialName' => Settings::get('officialName'),
                'year' => Carbon::now()->year,];
        switch ($page){
            case "about-ctu":
                $with += ['rector' => Settings::get('rector')];
                break;
            case "":
                $with += ['president' => Settings::get('president'),
                        'presidentPicture' => Settings::get('presidentPicture'),
                        'studentsCount' => ExchangeStudent::byUniqueSemester(Settings::get('currentSemester'))->count(),
                        'fullName' => Settings::get('fullName'),];
                $page = "home";
                break;
            case "first-steps":
                $with += ['wcFrom' => $this->dateToCorrectFormat(Settings::get('wcFrom')),
                            'owFrom' => $this->dateToCorrectFormat(Settings::get('owFrom')),
                            'owFromTo' => $this->dateToCorrectFormat(Settings::get('owFrom'), Settings::get('owTo')),
                ];
                break;
            case "orientation-week":
                $with += ['owFromTo' => $this->dateToCorrectFormat(Settings::get('owFrom'), Settings::get('owTo'))];
                break;
        }
        return view('guide.' . $page)->with($with);
    }

    private function dateToCorrectFormat($from, $to = null)
    {
        $dateFrom = Carbon::createFromFormat('d/m/Y' ,$from);
        $result = '';
        if($to == null) $result = $dateFrom->format('l, j F');
        else
        {
            $dateTo = Carbon::createFromFormat('d/m/Y' ,$to);
            if($dateFrom->year == $dateTo->year)
            {
                if($dateFrom->month != $dateTo->month )
                {
                    $result = $dateFrom->format('j F') .' – '. $dateTo->format('j F Y');
                }
                else
                {
                    $result = $dateFrom->format('j') .' – '. $dateTo->format('j F Y');
                }
            }
            else
            {
                $result = $dateFrom->format('j F Y') .' – '. $dateTo->format('j F Y');
            }
        }
        return $result;
    }
}
