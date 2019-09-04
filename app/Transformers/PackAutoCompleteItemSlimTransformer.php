<?php

namespace App\Transformers;

use App\PackAutoComplete;
use Illuminate\Support\Facades\Storage;
use League\Fractal\TransformerAbstract;

class PackAutoCompleteItemSlimTransformer extends TransformerAbstract
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
            'label' => (string) $packAutoComplete->name

        ];
    }

}
