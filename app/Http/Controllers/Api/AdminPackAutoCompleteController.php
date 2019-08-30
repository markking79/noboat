<?php

namespace App\Http\Controllers\Api;

use App\Transformers\PackAutoCompleteItemTransformer;
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

        $data = false;

        if ($terms)
        {
            $data = $packService->searchPackAutoCompleteItem($terms);

            if ($data)
                $data = fractal($data, new PackAutoCompleteItemTransformer())->toArray();
        }

        return json_encode($data);

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
