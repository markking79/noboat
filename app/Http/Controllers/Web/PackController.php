<?php

namespace App\Http\Controllers\Web;

use App\Services\SessionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

        $pack_filter_ounces_min = $sessionService->value('pack_filter_ounces_min', '', $request);
        $pack_filter_ounces_max = $sessionService->value('pack_filter_ounces_max', '', $request);
        $pack_filter_cost_min = $sessionService->value('pack_filter_cost_min', '', $request);
        $pack_filter_cost_max = $sessionService->value('pack_filter_cost_max', '', $request);
        $pack_filter_season_id = $sessionService->value('pack_filter_season_id', '', $request);
        $selected_pack_weight_units = $sessionService->value('selected_pack_weight_units', 'Imperial', $request);

        $pack_seasons = collect ();

        $packs = $packService->getAllPaginate(
            $page_number,
            $pack_filter_ounces_min,
            $pack_filter_ounces_max,
            $pack_filter_cost_min,
            $pack_filter_cost_max,
            $pack_filter_season_id);

        return view ('site/packs/index',
            compact('packs',
                'pack_filter_ounces_min',
                'pack_filter_ounces_max',
                'pack_filter_cost_min',
                'pack_filter_cost_max',
                'selected_pack_weight_units',
                'pack_filter_season_id',
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
