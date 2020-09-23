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
use Ramsey\Uuid\Uuid;

class AvatarController extends Controller
{
    public function upload(Request $request)
    {
        if (!$request->input('hash')) {
            $user = Auth::user();
            app()->setlocale('cs');
            setlocale(LC_ALL, __('web.locale-full'));
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

        $request->validate([
            'avatar_file' => ['required', 'file', 'image', 'max:2048'],
        ]);

        $person = Person::find($user->id_user);

        try {
            $img = Image::make(Input::file('avatar_file'));
        } catch (NotReadableException $e) {
            return response()->json([
                'state' => 400,
                'message' => __('validation.custom.avatar_file.uploaded'),
                'result' => ''
            ], 400);
        }

        $avatarData = json_decode(stripslashes($request->avatar_data));

        $img->crop(intval($avatarData->width), intval($avatarData->height), intval($avatarData->x), intval($avatarData->y));
        $img->resize(300, 300);

        $fileName = Uuid::uuid4() . '.jpg';
        while (Storage::exists("avatars/{$fileName}")) {
            $fileName = Uuid::uuid4() . '.jpg';
        }
        $dst = storage_path() . '/app/avatars/' . $fileName;
        Storage::makeDirectory('avatars');
        $img->save($dst);

        $oldAvatar = $person->avatar;

        $person->avatar = $fileName;
        $person->save();

        if (!empty($oldAvatar) && Storage::exists("avatars/{$oldAvatar}")) {
            Storage::delete("avatars/{$oldAvatar}");
        } elseif (count($oldAvatars = glob(storage_path("app/avatars/old/{$user->id_user}.*"))) > 0) {
            Storage::delete($oldAvatars);
        }

        return response()->json([
            'state' => 200,
            'message' => '',
            'result' => asset('avatars/' . $fileName)
        ]);
    }
}
