<?php

namespace App\Transformers;

use App\PackItem;
use Illuminate\Support\Facades\Storage;
use League\Fractal\TransformerAbstract;

class PackItemTransformer extends TransformerAbstract
{


    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(PackItem $packItem)
    {
        return [
            'name' => (string) $packItem->name,
            'description' => (string) $packItem->description,
            'purchase_link' => (string) $packItem->purchase_link,
            'image' => (string) (($packItem->image) ? Storage::url ($packItem->image) : ''),
            'cost_each' => (float) $packItem->cost_each,
            'quantity' => (int) $packItem->quantity,
            'ounces_each' => (float) $packItem->ounces_each,
            'imperial_each' => (string) $packItem->imperial_each,
            'metric_each' => (string) $packItem->metric_each,
        ];
    }

}
