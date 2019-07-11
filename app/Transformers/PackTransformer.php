<?php

namespace App\Transformers;

use App\Pack;
use League\Fractal\TransformerAbstract;

class PackTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'user'
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
        ];
    }

    /**
     * Include Author
     *
     * @return \League\Fractal\Resource\Item
     */
    public function includeUser(Pack $pack)
    {
        $user = $pack->user;

        return $this->item($user, new UserTransformer);
    }
}
