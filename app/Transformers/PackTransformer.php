<?php

namespace App\Transformers;

use App\Pack;
use League\Fractal\TransformerAbstract;
use Illuminate\Support\Facades\Storage;

class PackTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'user', 'season', 'categories'
    ];

    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(Pack $pack)
    {
        return [
            'id'    => (int) $pack->id,
            'name'  => (string) $pack->name,
            'image' => (string) (($pack->image) ? Storage::url ($pack->image) : ''),
            'heart_count'  => (int) $pack->heart_count,
            'item_count'  => (int) $pack->visible_item_count,
            'weight_ounces'  => (float) $pack->visible_ounces,
            'cost'  => (float) $pack->visible_cost,
        ];
    }

    /**
     * Include User
     *
     * @return \League\Fractal\Resource\Item
     */
    public function includeUser(Pack $pack)
    {
        $user = $pack->user;

        return $this->item($user, new UserTransformer);
    }

    /**
     * Include Season
     *
     * @return \League\Fractal\Resource\Item
     */
    public function includeSeason(Pack $pack)
    {
        if (!$pack->season)
            return;

        $packSeason = $pack->season;

        return $this->item($packSeason, new PackSeasonTransformer);
    }

    /**
     * Include Categories
     *
     * @return \League\Fractal\Resource\Collection
     */
    public function includeCategories(Pack $pack)
    {
        if (!$pack->categories)
            return;

        $packCategories = $pack->categories;

        return $this->collection($packCategories, new PackCategoryTransformer);
    }

}
