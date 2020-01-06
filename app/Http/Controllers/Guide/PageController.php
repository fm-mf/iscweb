<?php

namespace App\Http\Controllers\Guide;

use App\Models\Contact;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Facades\Settings;
use App\Models\ExchangeStudent;
use Illuminate\Support\Facades\View;

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
        switch ($page) {
            case "about-ctu":
                $with += ['rector' => Settings::get('rector')];
                break;
            case "":
                $with += [
                    'president' => Contact::byPosition('President')->first(),
                    'fullName' => Settings::get('fullName'),
                ];
                $page = "home";
                break;
            case "first-steps":
                $with += [
                    'wcFrom' => $this->dateToCorrectFormat(Settings::get('wcFrom')),
                    'owFrom' => $this->dateToCorrectFormat(Settings::get('owFrom')),
                    'owFromTo' => $this->dateToCorrectFormat(Settings::get('owFrom'), Settings::get('owTo')),
                ];
                break;
            case "orientation-week":
                $owFrom = Carbon::createFromFormat('d/m/Y', Settings::get('owFrom'));

                $with += [
                    'owFromTo' => $this->dateToCorrectFormat(Settings::get('owFrom'), Settings::get('owTo')),
                    'owDay1' => $this->owDateFormat($owFrom),
                    'owDay2' => $this->owDateFormat($owFrom->copy()->addDay(1)),
                    'owDay3' => $this->owDateFormat($owFrom->copy()->addDay(2)),
                    'owTripsDays' => $this->owInterval(
                        $owFrom->copy()->addDay(3),
                        $owFrom->copy()->addDay(6)
                    ),
                ];
                break;
                /* Temporary */
            case "about-CTU":
                $with += ['rector' => Settings::get('rector')];
                break;
            case "basic-information":
                $with = [
                    'wcFrom' => $this->dateToCorrectFormat(Settings::get('wcFrom')),
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
        } elseif (in_array($page, $this->aboutCtuSubpages)) {
            $with += ['aboutCtu' => ''];
        } elseif (in_array($page, $this->czechItOutSubpages)) {
            $with += ['czechItOut' => ''];
        } elseif (in_array($page, $this->iscEsnSubpages)) {
            $with += ['iscEsn' => ''];
        }
        $with += ['active' => $page];
        return view($viewName)->with($with);
    }

    private function owDateFormat(Carbon $date)
    {
        return $date->format('l (jS F)');
    }

    private function owInterval(Carbon $from, Carbon $to)
    {
        return $from->format('l') . ' to ' . $to->format('l')
            . ' ('
            . ($from->month !== $to->month
                ? $from->format('jS F') . ' – ' . $to->format('jS F')
                : $from->format('jS') . ' – ' . $to->format('jS F'))
            . ')';
    }

    private function dateToCorrectFormat($from, $to = null)
    {
        $dateFrom = $from instanceof Carbon
            ? $from
            : Carbon::createFromFormat('d/m/Y', $from);

        $result = '';
        if ($to == null) {
            $result = $dateFrom->format('l, j F');
        } else {
            $dateTo = $to instanceof Carbon
                ? $to
                : Carbon::createFromFormat('d/m/Y', $to);
            
            if ($dateFrom->year == $dateTo->year) {
                if ($dateFrom->month != $dateTo->month) {
                    $result = $dateFrom->format('j F') . ' – ' . $dateTo->format('j F Y');
                } else {
                    $result = $dateFrom->format('j') . ' – ' . $dateTo->format('j F Y');
                }
            } else {
                $result = $dateFrom->format('j F Y') . ' – ' . $dateTo->format('j F Y');
            }
        }
        return $result;
    }
}
