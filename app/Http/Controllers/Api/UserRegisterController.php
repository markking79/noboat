<?php

namespace App\Http\Controllers\Api;

use App\Services\UserService;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserRegisterController extends Controller
{
    //

    public function register (Request $request, UserService $userService)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email||unique:users',
            'password' => 'required_with:confirm_password|same:confirm_password'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();

            return response()->json([
                'message' => 'Error',
                'error' => $error
            ]);
        }

        $user = $userService->getByUuid(Session::getId());
        if ($user)
        {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save ();
            Auth::login($user, $remember = true);
        }
        else
        {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        }

        return response()->json([
            'message' => 'Success',
            'user_id' => $user->id
        ]);

    }
}
