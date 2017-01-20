<?php

namespace App\Http\Controllers\Api;

use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tools\Cropper;
use Illuminate\Support\Facades\Auth;

class AvatarController extends Controller
{
    public function upload(Request $request)
    {
        if (!$request->input('hash')) {
            $user = Auth::user();
        } else {
            $user = User::findByHash($request->input('hash'));
        }

        if (!$user) {
            return response()->json([
                'state' => 401,
                'message' => 'Not authorized',
                'result' => ''
            ]);
        }

        $person = Person::find($user->id_user);

        $cropper = new Cropper($request->input('avatar_src'), $request->input('avatar_data'), $request->file('avatar_file'));

        $person->avatar = $cropper->getResult();
        $person->save();


        return response()->json([
            'state' => 200,
            'message' => $cropper->getMsg(),
            'result' => asset('avatars/' . $cropper->getResult())
        ]);
    }
}
