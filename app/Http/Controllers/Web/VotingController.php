<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ExchangeStudent;
use App\Models\Country;
use App\Models\Vote;

use App\Settings\Facade as Settings;

class VotingController extends Controller
{
    private $activeCountries = ['FI', 'DE', 'KR', 'TW', 'CA', 'CN', 'TR', 'AR', 'ES', 'MX', 'GB', 'SE', 'FR', 'US', 'IN', 'AU', 'PT', 'SX'];

    public function showVotingForm($hash)
    {
        $user = User::findByHash($hash);

        if (!$user) {
            return view('web.voting.invalid');
        }

        if ($user->isExchangeStudent()) {
            $country = ExchangeStudent::find($user->id_user)->country;
        } else {
            $country = Country::where('two_letters', 'CZ')->first();
        }
        
        $countriesList = [];
        $countries = Country::whereIn('two_letters', $this->activeCountries)->where('id_country', '<>', $country->id_country)->get(); 
        foreach ($countries as $country) {
            if ($country->two_letters == "GB") {
                $countriesList[$country->id_country] = $country->full_name . ' (Scotland)';
            } else {
                $countriesList[$country->id_country] = $country->full_name;
            }
        }

        $currentSemesterId = \App\Models\Semester::where('semester', Settings::get('currentSemester'))->first()->id_semester;
        $vote = Vote::findVote($user->id_user, $currentSemesterId);

        if($vote) {
            $alreadyVoted = true;
            $bestShow = $vote->best_show;
            $bestFood = $vote->best_food;
        } else {
            $alreadyVoted = false;
            $bestShow = null;
            $bestFood = null;
        }
        
        return view('web.voting.form')->with([
            'countriesList' => $countriesList,
            'hash' => $hash,
            'alreadyVoted' => $alreadyVoted,
            'bestShow' => $bestShow,
            'bestFood' => $bestFood,
        ]);
    }

    public function processVoting(Request $request)
    {
        $user = User::findByHash($request->hash);
        if (!$user) {
            return redirect('/');
        }

        $semester = \App\Models\Semester::where('semester', Settings::get('currentSemester'))->first()->id_semester;
        Vote::registerVote($user->id_user, $semester, ['best_show' => $request->best_show, 'best_food' => $request->best_food]);        

        return redirect('/voting/thank-you');
    }

    public function showResults()
    {
        $this->authorize('acl', 'votingResults.view');
        $semesterId = \App\Models\Semester::where('semester', Settings::get('currentSemester'))->first()->id_semester;        

        $bestShow = Vote::groupBy('best_show')->select('best_show', 'countries.full_name', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
            ->leftJoin('countries', 'countries.id_country', '=', 'best_show')->where('id_semester', $semesterId)->orderBy('total', 'DESC')->get();

        $bestFood = Vote::groupBy('best_food')->select('best_food', 'countries.full_name', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
            ->leftJoin('countries', 'countries.id_country', '=', 'best_food')->where('id_semester', $semesterId)->orderBy('total', 'DESC')->get();

        return view('web.voting.results')->with([
            'bestShowCountries' => $this->collapseVotes($bestShow),
            'bestFoodCountries' => $this->collapseVotes($bestFood),
        ]);
    }

    public function showThankYou()
    {
        return view('web.voting.thankyou');
    }

    private function collapseVotes($countries) {
        $result = [];
        $min = 88888888;
        $i = -1;
        foreach ($countries as $country) {
            if ($i > 3 || $country->total == 0) {
                break;
            } else if ($country->total < $min) {
                $min = $country->total;
                $i++;
            }
            $result[$i][] = $country;
        }
        return $result;
    }
}
