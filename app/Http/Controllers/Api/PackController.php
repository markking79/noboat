<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\PackTransformer;
use App\Services\PackService;

class PackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    /**
     * List backpacks
     *
     * List all the public viewable packs using pagination
     *
     * @bodyParam page int optional The page number to return.
     *
     * @transformer \App\Transformers\PackTransformer
     */
    public function index(Request $request, PackService $packService)
    {
        $page_number = $request->get ('page', 1);

        $packs = $packService->getAllPaginate($page_number);

        if ($packs)
            $packs = fractal($packs, new PackTransformer())->parseIncludes(['season'])->toArray();
        
        return response()->json($packs);
    }

    /**
     * Display the specified resource.
     *
     * @param  int        $id
     * @param PackService $packService
     * @return \Illuminate\View\View
     */
    public function show($id, PackService $packService)
    {
        $pack = $packService->getById($id, true, true);

        if ($pack)
            $pack = fractal($pack, new PackTransformer())->parseIncludes(['user', 'season', 'categories', 'categories.items'])->toArray();

        return response()->json($pack);
    }
}
