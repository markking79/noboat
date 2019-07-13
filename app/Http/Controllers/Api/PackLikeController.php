<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\PackService;

class PackLikeController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, PackService $packService)
    {
        $pack_id = $request->get ('pack_id');
        $user_id = $request->user()->id;

        $packService->recordUserLike($pack_id, $user_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($pack_id, Request $request, PackService $packService)
    {
        $user_id = $request->user()->id;

        $packService->removeUserLike($pack_id, $user_id);
    }
}
