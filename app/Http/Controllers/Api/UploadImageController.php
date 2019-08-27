<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UploadImageRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UploadImageController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UploadImageRequest $request)
    {
        // allow max system memory, processing images can be memory intense
        ini_set('memory_limit','-1');

        //
        // get image from form post
        $image = $request->image;

        // check if image is uploaded
        if ($image)
        {
            // save image in temp folder
            $file = Storage::disk('public')->put('temp', $image);

            // get the fill image path
            $full_path_file = $path = Storage::disk('public')->path($file);

            // process the image so everything is perfect
            //$this->correctImageOrientationAndSave ($full_path_file);
            //$this->shrinkToMax1024AndSave ($full_path_file);
            //ImageOptimizer::optimize($full_path_file);

            // return needed data
            $return_data = new \stdClass();
            $return_data->asset_name = $file;
            $return_data->url = Storage::url ($file);

            return response()->json(array('image' => $return_data), 200);
        }
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
    public function destroy($id)
    {
        //
    }
}
