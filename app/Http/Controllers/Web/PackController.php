<?php

namespace App\Http\Controllers\Web;

use App\Services\SessionService;
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
    public function index(Request $request, PackService $packService, SessionService $sessionService)
    {
        $page_number = $request->get ('page', 1);

        $selected_pack_weight = $sessionService->value('selected_pack_weight', 'all', $request);
        $selected_pack_price = $sessionService->value('selected_pack_price', 'all', $request);
        $selected_pack_season = $sessionService->value('selected_pack_season', 'all', $request);
        $selected_pack_weight_units = $sessionService->value('selected_pack_weight_units', 'Imperial', $request);
        $pack_seasons = collect ();

        $packs = $packService->getAllPaginate($page_number, $selected_pack_weight, $selected_pack_price, $selected_pack_season);

        return view ('site/packs/index',
            compact('packs',
                'selected_pack_weight',
                'selected_pack_price',
                'selected_pack_season',
                'selected_pack_weight_units',
                'pack_seasons'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int        $id
     * @param PackService $packService
     * @return \Illuminate\View\View
     */
    public function show($id, Request $request, PackService $packService, SessionService $sessionService)
    {
        $pack_weight_units = $sessionService->value('pack_weight_units', 'Imperial', $request);

        $pack = $packService->getByIdWithOnlyPublicPackItems($id, $pack_weight_units);

        if (!$pack)
            abort(404);

        return view('site/packs/show', compact('pack', 'pack_weight_units'));
    }
}
