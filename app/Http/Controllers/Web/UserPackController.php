<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\PackFilterRequest;
use App\Repositories\PackSeasonRepository;
use App\Services\PackService;
use App\Services\SessionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserPackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PackFilterRequest $packFilterRequest, PackService $packService, SessionService $sessionService)
    {
        $user = auth()->user();

        $page_number = $packFilterRequest->get ('page', 1);
        $pack_weight_units = $sessionService->value('pack_weight_units', 'imperial', $packFilterRequest);

        $packs = $packService->getAllByUserIdPaginate($user->id, $page_number);

        return view ('user.packs.index', compact ('packs', 'pack_weight_units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(PackService $packService)
    {
        $user = auth()->user();

        $pack = $packService->store($user->id);

        return redirect(route ('user.packs.edit', ['pack' => $pack]));

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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, SessionService $sessionService, PackService $packService, PackSeasonRepository $packSeasonRepository)
    {
        $user = auth()->user();

        $pack_weight_units = $sessionService->value('pack_weight_units', 'imperial');

        $pack_seasons = $packSeasonRepository->getAll();

        $pack = $packService->getByIdAndUserId ($id, $user->id, $with_categories = true, $return_only_visible_categories = false);

        return view('user.packs.edit', [
            'pack_weight_units' => $pack_weight_units,
            'pack_seasons' => $pack_seasons,
            'pack' => $pack
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
