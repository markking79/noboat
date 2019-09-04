<?php

namespace App\Http\Controllers\Api;

use App\Services\PackService;
use App\Transformers\PackAutoCompleteItemSlimTransformer;
use App\Transformers\PackAutoCompleteItemTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserPackAutoCompleteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, PackService $packService)
    {
        $terms = $request->term;

        $data = false;
        $data['data'] = false;

        if ($terms)
        {
            $data = $packService->searchPackAutoCompleteItem($terms);

            if ($data)
                $data = fractal($data, new PackAutoCompleteItemSlimTransformer)->toArray();
        }

        return json_encode($data['data']);

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
    public function show($id, PackService $packService)
    {
        //

        $data = $packService->getPackAutoCompleteById($id);

        if ($data)
        {
            $data = fractal($data, new PackAutoCompleteItemTransformer)->toArray();
            return json_encode($data['data']);
        }

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
