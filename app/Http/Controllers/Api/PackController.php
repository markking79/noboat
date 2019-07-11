<?php

namespace App\Http\Controllers\Api;

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
    public function show($id, Request $request, PackService $packService)
    {
        $pack_weight_units = $request->get('pack_weight_units', 'Imperial');

        $pack = $packService->getByIdWithOnlyPublicPackItems($id, $pack_weight_units);

        return response()->json($pack);
    }
}
