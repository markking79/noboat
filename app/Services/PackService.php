<?php

namespace App\Services;

use App\Repositories\PackRepository;
use App\Repositories\PackCategoryRepository;
use Illuminate\Support\Collection;

class PackService
{

    private $packRepository;
    private $packCategoryRepository;

    public function __construct(PackRepository $packRepository, PackCategoryRepository $packCategoryRepository)
    {
        $this->packRepository = $packRepository;
        $this->packCategoryRepository = $packCategoryRepository;
    }

    public function getAllPaginate ($page, $ounces_min = false, $ounces_max = false, $cost_min = false, $cost_max = false, $season_id = false)
    {
        $packs = $this->packRepository->getAllWithSeasonPaginate($page, $ounces_min, $ounces_max, $cost_min, $cost_max, $season_id);

        return $packs;
    }

    public function getById ($id)
    {
        $pack = $this->packRepository->getByIdWithAllPackItems($id);

        if (!$pack) return false;

        $categories = $this->packCategoryRepository->getAll();

        $pack->categories = $this->groupItemsByCategories ($pack, $categories, $return_only_visible = true);
        $pack->unsetRelation('items');
        $this->fillCategoryStats ($pack->categories);


        return $pack;
    }

    public function getByIdWithAllPackItems ($id)
    {
        $pack = $this->packRepository->getByIdWithAllPackItems($id);

        if (!$pack) return false;

        $categories = $this->packCategoryRepository->getAll();

        $pack->categories = $this->groupItemsByCategories ($pack, $categories, $return_only_visible = false);
        $pack->unsetRelation('items');
        $this->fillCategoryStats ($pack->categories);

        return $pack;
    }

    private function groupItemsByCategories (&$pack, &$categories, $return_only_visible = false) : Collection
    {
        $categoriesWithItems = collect ();

        if ($categories)
        {
            foreach ($categories as $category)
            {
                $includeCategory = $category->is_visible;

                if (!$return_only_visible)
                    $includeCategory = true;

                if ($includeCategory)
                {
                    $category['items'] = $pack->items->where ('category_id', $category->id);
                    $categoriesWithItems->push ($category);
                }
            }
        }

        return $categoriesWithItems;
    }

    private function fillCategoryStats (&$categories)
    {
        if ($categories)
        {

            $i = 0;
            foreach ($categories as $category)
            {

                $total_ounces = 0;
                $total_cost = 0;
                $item_count = 0;

                $category->item_count = 0;
                if ($category['items'])
                {
                    foreach ($category['items'] as $item)
                    {
                        $total_ounces += $item->ounces_each * $item->quantity;
                        $total_cost += $item->cost_each * $item->quantity;
                        $item_count +=  $item->quantity;
                    }
                }

                $categories[$i]->total_ounces = $total_ounces;
                $categories[$i]->total_cost = $total_cost;
                $categories[$i]->item_count = $item_count;

                $i++;
            }
            //dd ($categories);
        }
    }
}