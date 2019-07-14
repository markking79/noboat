<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\UserUpdateRequest;
use App\Http\Controllers\Controller;
use App\Services\UserService;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('user.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = auth()->user ();
        return view ('user.account.edit', compact ('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, UserService $userService)
    {
        $user = auth()->user ();
        $userService->update ($user->id, $request->all());

        return view ('user.account.update');
    }
}
