<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Exception\NotReadableException;

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

        try {
            $fileName = $user->person->storeAvatar(
                $request->file('avatar_file'),
                $request->get('avatar_data')
            );
        } catch (NotReadableException $e) {
            return response()->json([
                'state' => 400,
                'message' => __('validation.custom.avatar_file.uploaded'),
                'result' => ''
            ], 400);
        }

        return response()->json([
            'state' => 200,
            'message' => '',
            'result' => asset('avatars/' . $fileName)
        ]);
    }
}
