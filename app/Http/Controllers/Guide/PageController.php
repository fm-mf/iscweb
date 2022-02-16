<?php

namespace App\Http\Controllers\Guide;

use App\Facades\Settings;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Contact;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

class PageController extends Controller
{
    private $firstStepsSubpages = ['introduction', 'welcome-pack', 'orientation-week', 'cards', 'kos', 'eduroam'];
    private $aboutCtuSubpages = ['academic-year', 'campus', 'classrooms', 'dormitories'];
    private $czechItOutSubpages = ['visa', 'visa-example-pictures', 'health-care', 'living-in-prague', 'transportation', 'money-exchange', 'post-office', 'phone', 'culture-shock', 'czech-phrases', 'funny-facts'];
    private $iscEsnSubpages = ['isc-intro', 'esn-intro', 'esn-partners'];

    public function showPage(string $page = '')
    {
        $with = [
            'active' => $page,
            'year' => now()->year,
        ];

        switch ($page) {
            case 'ow':
                return redirect()->route('guide-page', ['page' => 'orientation-week'], Response::HTTP_MOVED_PERMANENTLY);
            case '':
                $with += [
                    'president' => Contact::byPosition('President')->first(),
                ];
                $page = 'home';
                break;
            case 'orientation-week':
                $owFrom = Settings::owFrom();

                $with += [
                    'owDay1' => $this->owDateFormat($owFrom),
                    'owDay2' => $this->owDateFormat($owFrom->copy()->addDay(1)),
                    'owDay3' => $this->owDateFormat($owFrom->copy()->addDay(2)),
                    'owTripsDays' => $this->owInterval(
                        $owFrom->copy()->addDay(3),
                        $owFrom->copy()->addDay(6)
                    ),
                ];
                break;
            case 'classrooms':
                $with += [
                    'buildings' => Building::orderByCode()->get(),
                ];
                break;
        }

        $viewName = "guide.$page";
        if (!view()->exists($viewName)) {
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

        return view($viewName)->with($with);
    }

    private function owDateFormat(Carbon $date): string
    {
        return $date->format('l (j F)');
    }

    private function owInterval(Carbon $from, Carbon $to): string
    {
        return $from->format('l') . ' to ' . $to->format('l')
            . ' ('
            . ($from->month !== $to->month
                ? $from->format('j F') . ' – ' . $to->format('j F')
                : $from->format('j') . '–' . $to->format('j F'))
            . ')';
    }
}
