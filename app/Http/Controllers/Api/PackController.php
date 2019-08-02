<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\PackTransformer;
use App\Services\PackService;

/**
 * @group Packs
 *
 * APIs for listing and viewing packs
 */
class PackController extends Controller
{
    /**
     * List backpacks
     *
     * List all the public viewable packs using pagination
     *
     * @queryParam page The page number. Example: 1
     *
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
     * Get a backpack
     *
     * Get a pack and all the attached details
     *
     * @queryParam id required The pack id. Example: 1
     *
     */
    public function show($id, PackService $packService)
    {
        $pack = $packService->getById($id, true, true);

        if ($pack)
            $pack = fractal($pack, new PackTransformer())->parseIncludes(['user', 'season', 'categories', 'categories.items'])->toArray();

        return response()->json($pack);
    }
}
