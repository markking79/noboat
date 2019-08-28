<?php

namespace App\Http\Controllers\Api;

use App\Services\PackService;
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
        $terms = $request->terms;

        if ($terms)
        {
            $data = $packService->searchPackAutoCompleteItem($terms);
        }

        return json_encode($data);


        $splitTerm = explode(' ', $terms);
        if (!$splitTerm)
            return;

        $whereArray = array();
        foreach ($splitTerm as $term)
            $whereArray[] = ['name', 'LIKE', "%$term%"];


        $results = \App\Packautocomplete::where($whereArray)->get(['id', 'name']);

        $slimmed_down = $results->map(function ($item, $key) {
            return [
                'label' => $item->name,
                'id' => $item->id,
            ];
        });

        return json_encode($slimmed_down);
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
    public function destroy($id, PackService $packService)
    {
        $packService->deletePackAutoCompleteItem($id);
    }
}
