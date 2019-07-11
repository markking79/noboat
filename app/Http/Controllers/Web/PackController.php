<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\SessionService;
use App\Services\PackService;

class PackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view ('site/packs/index');
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
