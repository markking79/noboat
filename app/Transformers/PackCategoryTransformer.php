<?php

namespace App\Transformers;

use App\PackCategory;
use App\PackItem;
use League\Fractal\TransformerAbstract;

class PackCategoryTransformer extends TransformerAbstract
{

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'items'
    ];

    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(PackCategory $packCategory)
    {
        return [
            'name' => (string) $packCategory->name,
            'description' => (string) $packCategory->description,
            'total_ounces' => (float) $packCategory->total_ounces,
            'total_cost' => (float) $packCategory->total_cost,
            'item_count' => (int) $packCategory->item_count,
        ];
    }

    /**
     * Include Categories
     *
     * @return \League\Fractal\Resource\Collection
     */
    public function includeItems(PackCategory $packCategory)
    {
        if (!$packCategory->items)
            return;

        $packItems = $packCategory->items;

        return $this->collection($packItems, new PackItemTransformer);
    }

}
