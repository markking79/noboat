<?php

namespace App\Http\Controllers\Api;

use App\PackItem;
use App\Repositories\PackItemRepository;
use App\Services\PackService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UserPackItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, PackService $packService)
    {
        //
        $item_id = $packService->storePackItem($request->only(['pack_id', 'name', 'category_id', 'description', 'purchase_link', 'ounces_each', 'cost_each', 'quantity', 'image', 'weight']));

        $item = $packService->getPackItemById($item_id);

        if ($item)
        {
            return json_encode(['id' => $item->id, 'image' => Storage::url($item->image)]);
        }

        return json_encode(false);
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
        $packService->updatePackItem($id, $request->only(['pack_id', 'name', 'category_id', 'description', 'purchase_link', 'ounces_each', 'cost_each', 'quantity', 'image', 'weight']));

        $item = $packService->getPackItemById($id);

        if ($item)
        {
            return json_encode(['id' => $item->id, 'image' => Storage::url($item->image)]);
        }

        return json_encode(false);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, PackService $packService)
    {
        //
        $packService->destoryPackItem($id);
    }
}
