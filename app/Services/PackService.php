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

    public function getByIdWithOnlyPublicPackItems ($id)
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