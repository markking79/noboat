<?php

namespace App\Http\Controllers\Web;

use App\Services\SessionService;
use App\Http\Controllers\Controller;
use App\Services\PackService;
use App\Repositories\PackSeasonRepository;
use App\Http\Requests\PackFilterRequest;

class PackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(PackFilterRequest $packFilterRequest, PackService $packService, SessionService $sessionService, PackSeasonRepository $packSeasonRepository)
    {
        $page_number = $packFilterRequest->get ('page', 1);

        $pack_filter_ounces_min = $sessionService->value('pack_filter_ounces_min', '', $packFilterRequest);
        $pack_filter_ounces_max = $sessionService->value('pack_filter_ounces_max', '', $packFilterRequest);
        $pack_filter_cost_min = $sessionService->value('pack_filter_cost_min', '', $packFilterRequest);
        $pack_filter_cost_max = $sessionService->value('pack_filter_cost_max', '', $packFilterRequest);
        $pack_filter_season_id = $sessionService->value('pack_filter_season_id', '', $packFilterRequest);
        $pack_weight_units = $sessionService->value('pack_weight_units', 'imperial', $packFilterRequest);

        $pack_seasons = $packSeasonRepository->getAll();

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
                'pack_weight_units',
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
    public function show($id, PackFilterRequest $packFilterRequest, PackService $packService, SessionService $sessionService)
    {
        $pack_weight_units = $sessionService->value('pack_weight_units', 'imperial', $packFilterRequest);

        $pack = $packService->getById($id, true, true);

        if (!$pack)
            abort(404);

        //dd ($pack);

        return view('site/packs/show', compact('pack', 'pack_weight_units'));
    }
}
