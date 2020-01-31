<?php

namespace App\Http\Controllers\Api;

use App\Models\Country;
use App\Models\ExchangeStudent;
use App\Models\Trip;
use App\Facades\Settings ;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OwTripResource;
use Illuminate\Support\Facades\App;

class StatsController extends Controller
{
    public function getOwTrips()
    {
        $trips = Trip::with('event')
                ->where('trip_date_to', '>=', Carbon::now('Europe/Prague'))
                ->whereHas('event', function ($query) {
                    $query->where('ow', '=', '1');
                })->get();
        
        return response()->json(OwTripResource::collection($trips));
    }
}
