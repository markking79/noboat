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

    public function getAllPaginate ($page, $weight_range, $price_range, $season_id)
    {
        if ($weight_range != 'all')
        {
            $splitWeight = explode("-", $weight_range);
            $ounces_min = $splitWeight[0];
            $ounces_max = false;
            if (isset($splitWeight[1]))
                $ounces_max = $splitWeight[1];
        }

        if ($pack_price != 'all')
        {
            $splitPrice = explode("-", $pack_price);
            $startPrice = $splitPrice[0];
            $endPrice = false;
            if (isset($splitPrice[1]))
                $endPrice = $splitPrice[1];
        }

        if ($pack_season != 'all')
        {

            $whereArray[] = ['packseason_id', '=', $pack_season];
        }



        $packs = $this->packRepository->getAllByColumnsWithSeasonPaginate($page, $ounces_min, $ounces_max, $cost_min, $cost_max, $season_id);

        return $packs;
    }

    public function getById ($id)
    {
        $pack = $this->packRepository->getByIdWithAllPackItems($id);

        if (!$pack) return false;

        $categories = $this->packCategoryRepository->getAll();

        $pack->categories = $this->groupItemsByCategories ($pack, $categories, $return_only_visible = true);
        $pack->unsetRelation('items');


        return $pack;
    }

    public function getByIdWithAllPackItems ($id)
    {
        $pack = $this->packRepository->getByIdWithAllPackItems($id);

        if (!$pack) return false;

        $categories = $this->packCategoryRepository->getAll();

        $pack->categories = $this->groupItemsByCategories ($pack, $categories, $return_only_visible = false);
        $pack->unsetRelation('items');


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
}