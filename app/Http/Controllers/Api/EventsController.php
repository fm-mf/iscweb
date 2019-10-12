<?php

namespace App\Http\Controllers\Api;

use App\Models\Buddy;
use App\Models\ExchangeStudent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\PreregistrationResponse;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EventsController extends Controller
{
    use AuthenticatesUsers;

    public function getExchangeStudent(Request $request)
    {
        try {
            $student = ExchangeStudent::findByEmailAndEsn($request->input('email'), $request->input('esn'))->firstOrFail();
            return response()->json($student);
        } catch (\Exception $e) {
            throw new NotFoundHttpException('Invalid e-mail and ESN carn number combination');
        }
    }

    public function register(Request $request)
    {
        $this->responseValidator($request->all())->validate();

        $id_user = (int)$request->input('id_user');

        if (PreregistrationResponse::hasUser($id_user)) {
            return response()->json([
                'message' => 'User is already registered for this event'
            ], 400);
        }

        // TODO: Validate if event is open for registrations

        $response = new PreregistrationResponse();
        $response->id_event = Event::findByHash($request->input('event'))->firstOrFail()->id_event;
        $response->id_user = $id_user;
        $response->medical_issues = $request->input('medical_issues');
        $response->diet = $request->input('diet');
        $response->notes = $request->input('notes');
        $response->save();
        
        return response()->json($response);
    }

    private function responseValidator(array $data)
    {
        return Validator::make($data, [
            'id_user' => 'int|required',
            'diet' => 'in:Vegetarian,Vegan,Fish only',
            'medical_issues' => 'string|max:1024',
            'notes' => 'string|max:1024'
        ]);
    }

    protected function sendLoginResponse(Request $request)
    {
        $this->clearLoginAttempts($request);

        $details = User::with('person')->where('id_user', $this->guard()->user()->id_user)->first();

        return response()->json($details);
    }

    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        $credentials['password'] = User::encryptPassword($credentials[$this->username()], $credentials['password']);
        return $credentials;
    }
}
