<?php

namespace App\Transformers;

use App\PackAutoComplete;
use Illuminate\Support\Facades\Storage;
use League\Fractal\TransformerAbstract;

class PackAutoCompleteItemTransformer extends TransformerAbstract
{


    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(PackAutoComplete $packAutoComplete)
    {
        return [
            'id' => (int) $packAutoComplete->id,
            'name' => (string) $packAutoComplete->name,
            'description' => (string) $packAutoComplete->description,
            'purchase_link' => (string) $packAutoComplete->purchase_link,
            'image_asset' => (string) $packAutoComplete->image,
            'image' => (string) (($packAutoComplete->image) ? Storage::url ($packAutoComplete->image) : ''),
            'price' => (float) $packAutoComplete->price,
            'ounces' => (float) $packAutoComplete->ounces,
        ];
    }

}
