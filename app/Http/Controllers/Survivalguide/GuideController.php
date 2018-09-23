<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 17.01.2017
 * Time: 13:36
 */
namespace App\Http\Controllers\Survivalguide;

use App\Facades\Settings ;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GuideController extends Controller
{
    public function showMainGuide()
    {

        return view('survivalguide.guide')->with( ['president' => Settings::get('currentPresident') ]);
    }
}