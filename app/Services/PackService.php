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

    public function getByIdWithOnlyPublicPackItems ($id, $pack_weight_units = 'Imperial')
    {
        $pack = $this->packRepository->getByIdWithAllPackItems($id);

        if (!$pack) return false;

        $categories = $this->packCategoryRepository->getAll();

        $pack->categories = $this->groupItemsByCategories ($pack, $categories);
        $pack->unsetRelation('items');

        //dd ($pack);
        return $pack;
    }

    private function groupItemsByCategories ($pack, $categories) : Collection
    {
        $categoriesWithItems = collect ();

        if ($categories)
        {
            foreach ($categories as $category)
            {
                $category['items'] = $pack->items->where ('category_id', $category->id);
                $categoriesWithItems->push ($category);
            }
        }

        return $categoriesWithItems;
    }
}