<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * @group Authentication
 *
 * APIs for logging in
 */
class UserLoginController extends Controller
{
    /**
     * Login
     *
     * Login and return the bearer token
     *
     * @bodyParam email required The user's email address. Example: test@test.com
     * @bodyParam password required The user's password. Example: password
     *
     * @response {
     *  "access_token": "{token}",
     *  "token_type": "Bearer",
     *  "expires_at": "2029-08-02 04:16:22"
     * }
     *
     * @response 401 {
     *  "message": "Unauthorized"
     * }
     */
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $credentials = request(['email', 'password']);

        $success = Auth::guard('web')->attempt($credentials, $remember = true);

        if(!$success)
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);

        $user = $request->user();

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        $token->expires_at = Carbon::now()->addYears(10);

        $token->save();

        return response()->json([
            'message' => 'Authorized',
            'user_id' => $user->id,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

}
