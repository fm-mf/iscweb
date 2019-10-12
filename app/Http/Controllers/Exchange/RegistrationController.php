<?php

namespace App\Http\Controllers\Exchange;

use App\Models\Accommodation;
use App\Models\Arrival;
use App\Models\ExchangeStudent;
use App\Models\Person;
use App\Models\Transportation;
use App\Models\Trip;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegistrationController extends Controller
{
  public function showForm()
  {
    return view('exchange.form');
  }
}