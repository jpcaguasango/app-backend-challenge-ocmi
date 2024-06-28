<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoginRequest;
use App\Models\Authenticate;
use App\Models\User;
use App\Utils\Enums\Codes;
use App\Utils\Enums\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class AuthController extends Controller
{
    /**
     * Store a newly created user authenticate.
     */
    public function login(StoreLoginRequest $request)
    {
        // Request data
        $username = $request->username;
        $password = $request->password;

        $code = Codes::UNAUTHORIZED;
        $status = Status::ERROR;
        $message = Lang::get('validation.invalid_credentials');
        $data = null;


        $isValid = Auth::attempt(['username' => $username, 'password' => $password]);

        if ($isValid) {
            // Get user data
            $user = User::where([['username', $username]])->first();

            // Generate token
            if ($user) {
                $data = ["user" => $user, "token" => Authenticate::generateToken($user)];
                $code = Codes::SUCCESS;
                $status = Status::SUCCESS;
                $message = Lang::get('validation.valid_credentials');
            }
        }

        // Build the response to be sent to the client
        $res = [
            "code" => $code,
            "status" => $status,
            "message" => $message,
            "data" => $data,
        ];

        // Return the answer to the client
        return response()->json($res, $res['code']);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        User::removeTokens($user);
    }
}
