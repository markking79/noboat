<?php

namespace App\Http\Controllers\Api;

use App\Services\PackService;
use App\Transformers\PackTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @group User Packs
 *
 * APIs for listing and viewing user's packs
 */
class UserPackController extends Controller
{
    /**
     * List user's backpacks
     *
     * List all the user's packs using pagination
     *
     * @queryParam page The page number. Example: 1
     *
     * @response 401 {
     *  "message": "Unauthorized"
     * }
     */
    public function index(Request $request, PackService $packService)
    {
        $user = auth()->user();

        $page_number = $request->get ('page', 1);

        $packs = $packService->getAllByUserIdPaginate($user->id, $page_number);

        if ($packs)
            $packs = fractal($packs, new PackTransformer())->parseIncludes(['season'])->toArray();

        return response()->json($packs);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, PackService $packService)
    {
        //
        $packService->update($id, $request->only(['user_id', 'name', 'is_visible', 'season_id', 'image']));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, PackService $packService)
    {
        $user = auth()->user();

        $pack = $packService->getByIdAndUserId ($id, $user->id);

        if ($pack)
        {
            $packService->delete ($pack->id);
        }

    }
}
