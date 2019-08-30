<?php

namespace App\Http\Controllers\Web;

use App\PackItem;
use App\Services\PackService;;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminPackAutoCompleteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, PackService $packService)
    {
        $page_number = $request->get ('page', 1);
        $items = $packService->getPackAutoCompletesPaginate ($page_number);

        return view ('admin.packs.auto_completes.index', compact ('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, PackService $packService)
    {
        if ($request->pack_id)
        {
            $item = PackItem::findOrFail($request->pack_id);
            $item->image = $packService->copyPackItemImageAndSaveForAutoComplete ($item);
        }
        else
            $item = new PackItem();

        return view ('admin.packs.auto_completes.create', compact('item'));
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
        $packService->storePackAutoCompleteItem($request->only(['name', 'description', 'purchase_link', 'ounces', 'price', 'image_file']));
        //dd ($request);

        return view ('admin.packs.auto_completes.store');
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
    public function edit($id)
    {
        dd ($id);
        return view ('admin.packs.auto_completes.edit');
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
