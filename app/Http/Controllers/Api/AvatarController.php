<?php

namespace App\Http\Controllers\Api;

use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Exception\NotReadableException;
use Intervention\Image\Facades\Image;

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

        try {
            $img = Image::make(Input::file('avatar_file'));
        } catch (NotReadableException $e) {
            return response()->json([
                'state' => 400,
                'message' => 'The selected image file size is too large. Please, select a smaller one (maximum allowed size is 2 MiB)',
                'result' => ''
            ], 400);
        }

        $avatarData = json_decode(stripslashes($request->avatar_data));

        $img->crop(intval($avatarData->width), intval($avatarData->height), intval($avatarData->x), intval($avatarData->y));
        $img->resize(300, 300);

        $fileName = \Ramsey\Uuid\Uuid::uuid4() . '.jpg';
        $dst = storage_path() . '/app/avatars/' . $fileName;
        Storage::makeDirectory('avatars');
        $img->save($dst);

        $person->avatar = $fileName;
        $person->save();


        return response()->json([
            'state' => 200,
            'message' => '',
            'result' => asset('avatars/' . $fileName)
        ]);
    }
}
