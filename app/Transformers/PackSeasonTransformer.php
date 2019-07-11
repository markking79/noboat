<?php

namespace App\Transformers;

use App\PackSeason;
use League\Fractal\TransformerAbstract;

class PackSeasonTransformer extends TransformerAbstract
{

    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(PackSeason $packSeason)
    {
        return [
            'name' => (string) $packSeason->name,
        ];
    }

}
