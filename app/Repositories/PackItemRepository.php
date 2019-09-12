<?php

namespace App\Repositories;


use App\PackItem;
use Illuminate\Support\Facades\Cache;

class PackItemRepository implements PackItemRepositoryInterface
{
    private $secondsCache = 1;

    function __construct()
    {
        $this->secondsCache = config('custom.seconds_database_cache');
    }

    public function getById ($id)
    {
        $data = Cache::tags('pack_items')->remember('pack_item-'.$id, $this->secondsCache, function () use ($id) {
            return PackItem::where ('id', $id)->first ();
        });

        return $data;
    }

    public function getByPackId ($pack_id)
    {
        $data = Cache::tags('pack_items')->remember('pack_items-'.$pack_id, $this->secondsCache, function () use ($pack_id) {
            return PackItem::where ('pack_id', $pack_id)->get ();
        });

        return $data;
    }

    public function store ($values)
    {

        if ($values['name'] == null)
            $values['name'] = '';

        if ($values['ounces_each'] == null)
            $values['ounces_each'] = 0;

        if ($values['cost_each'] == null)
            $values['cost_each'] = 0;

        if ($values['quantity'] == null)
            $values['quantity'] = 1;

        if ($values['ounces_each'] == null)
            $values['ounces_each'] = 0;

        if (!isset($values['weight']))
            $values['weight'] = 0;
        else if ($values['weight'] == null)
            $values['weight'] = 0;

        $weight = 0;
        $items = $this->getByPackId ($values['pack_id']);

        if ($items)
            foreach ($items as $item)
            {
                if ($item->weight > $weight)
                    $weight = $item->weight;
            }

        $weight += 10;
        $values['weight'] = $weight;

        $item = PackItem::create ($values);

        return $item->id;

    }

    public function update ($id, $values)
    {
        $item = $this->getById($id);
        if ($item)
        {
            $item->fill ($values);
            $item->save ();
        }
    }

    public function resort ($values)
    {

        $categories = $values['categories'];

        $weight = 10;
        if ($categories)
        {
            foreach ($categories as $cat_id => $categoryItems)
            {
                if ($categoryItems)
                {
                    foreach ($categoryItems as $item_id)
                    {
                        $item = $this->getById ($item_id);
                        $item->category_id = $cat_id;
                        $item->weight = $weight;
                        $item->save ();
                        $weight += 10;
                    }
                }
            }
        }
    }

    public function destory ($id)
    {
        PackItem::destroy ($id);
    }

    public function clearCache ()
    {
        Cache::tags('pack_items')->flush();
    }
}