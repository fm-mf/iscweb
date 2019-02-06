<?php

namespace App\Http\Controllers\Guide;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Facades\Settings ;
use App\Models\ExchangeStudent;
use Illuminate\Support\Facades\View;
use App\Facades\Contacts;

class PageController extends Controller
{
    private $firstStepsSubpages = ['introduction', 'welcome-pack', 'orientation-week', 'cards', 'kos', 'eduroam'];
    private $aboutCtuSubpages = ['academic-year', 'campus', 'dormitories'];
    private $czechItOutSubpages = ['visa', 'visa-example-pictures', 'health-care', 'living-in-prague', 'transportation', 'money-exchange', 'post-office', 'phone', 'culture-shock', 'czech-phrases', 'funny-facts'];
    private $iscEsnSubpages = ['isc-intro', 'esn-intro', 'esn-partners'];

    public function showPage($page = "")
    {
        // dd(Contacts::getContactByPosition('President'));
        $with = [
            'shortName' => Settings::get('shortName'),
            'officialName' => Settings::get('officialName'),
            'year' => Carbon::now()->year,
        ];
        switch ($page){
            case "about-ctu":
                $with += ['rector' => Settings::get('rector')];
                break;
            case "":
                $with += [
                    'president' => Contacts::getContactByPosition('President'),
                    'fullName' => Settings::get('fullName'),
                ];
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
            /* Temporary */
            case "about-CTU":
                $with += ['rector' => Settings::get('rector')];
                break;
            case "basic-information":
                $with = ['wcFrom' => $this->dateToCorrectFormat(Settings::get('wcFrom')),
                        'owFrom' => $this->dateToCorrectFormat(Settings::get('owFrom')),
                        'owFromTo' => $this->dateToCorrectFormat(Settings::get('owFrom'), Settings::get('owTo')),
                ];
                break;
            /* /Temporary */
        }
        $viewName = 'guide.' . $page;
        if (!View::exists($viewName)) {
            abort(404);
        }
        if (in_array($page, $this->firstStepsSubpages)) {
            $with += ['firstSteps' => ''];
        } else if (in_array($page, $this->aboutCtuSubpages)) {
            $with += ['aboutCtu' => ''];
        } else if (in_array($page, $this->czechItOutSubpages)) {
            $with += ['czechItOut' => ''];
        } else if (in_array($page, $this->iscEsnSubpages)) {
            $with += ['iscEsn' => ''];
        }
        $with += ['active' => $page];
        return view($viewName)->with($with);
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
