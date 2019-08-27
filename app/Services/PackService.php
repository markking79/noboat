<?php

namespace App\Services;

use App\Repositories\PackRepository;
use App\Repositories\PackCategoryRepository;
use App\Repositories\PackAutoCompleteRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class PackService
{

    private $packRepository;
    private $packCategoryRepository;
    private $packAutoCompleteRepository;

    public function __construct(PackRepository $packRepository, PackCategoryRepository $packCategoryRepository, PackAutoCompleteRepository $packAutoCompleteRepository)
    {
        $this->packRepository = $packRepository;
        $this->packCategoryRepository = $packCategoryRepository;
        $this->packAutoCompleteRepository = $packAutoCompleteRepository;
    }

    public function store ($user_id)
    {
        return $this->packRepository->store($user_id);
    }

    public function getAllPaginate ($page, $ounces_min = false, $ounces_max = false, $cost_min = false, $cost_max = false, $season_id = false)
    {
        $packs = $this->packRepository->getAllWithSeasonPaginate($page, $ounces_min, $ounces_max, $cost_min, $cost_max, $season_id);

        return $packs;
    }

    public function getAllByUserIdPaginate ($user_id, $page, $ounces_min = false, $ounces_max = false, $cost_min = false, $cost_max = false, $season_id = false)
    {
        $packs = $this->packRepository->getAllByUserIdWithSeasonPaginate($user_id, $page, $ounces_min, $ounces_max, $cost_min, $cost_max, $season_id);

        return $packs;
    }

    public function getById ($id, $with_categories = false, $return_only_visible_categories = true)
    {
        if ($with_categories)
            $pack = $this->packRepository->getByIdWithAllPackItems($id);
        else
            $pack = $this->packRepository->getById($id);

        if (!$pack) return false;

        if ($with_categories)
        {
            $categories = $this->packCategoryRepository->getAll();

            $pack->categories = $this->groupItemsByCategories ($pack, $categories, $return_only_visible_categories);
            $pack->unsetRelation('items');
            $this->fillCategoryStats ($pack->categories);
        }

        return $pack;
    }

    public function getByIdAndUserId ($id, $user_id, $with_categories = false, $return_only_visible_categories = true)
    {
        $pack = $this->getById ($id, $with_categories, $return_only_visible_categories);
        if (!$pack)
            return false;

        if ($pack->user_id != $user_id)
            return false;

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

    public function recordUserLike ($pack_id, $user_id)
    {
        $pack = $this->getById ($pack_id);

        if (!$pack)
            return;

        $pack->likes ()->syncWithoutDetaching ($user_id);
        $pack->heart_count = $pack->likes->count ();
        $pack->touch ();
        $pack->save ();
    }

    public function removeUserLike ($pack_id, $user_id)
    {
        $pack = $this->getById ($pack_id);

        if (!$pack)
            return;

        $pack->likes ()->detach ($user_id);
        $pack->heart_count = $pack->likes->count ();
        $pack->touch ();
        $pack->save ();

    }

    public function calculateAndSavePackStats ($pack)
    {
        $item_count = 0;
        $ounces = 0;
        $cost = 0;

        if (!$pack->categories)
        {
            $categories = $this->packCategoryRepository->getAll();

            $pack->categories = $this->groupItemsByCategories ($pack, $categories);
        }


        if ($pack->categories)
        {
            foreach ($pack->categories as $category)
            {
                if ($category->is_visible && $category->include_in_base_weight)
                {
                    $ounces += $category->total_ounces;
                    $cost += $category->total_cost;
                }

                if ($category->is_visible)
                {
                    $item_count += $category->item_count;
                }

            }
        }

        $categories = $pack->categories;
        unset ($pack->categories);
        $pack->visible_item_count = $item_count;
        $pack->visible_ounces  = $ounces;
        $pack->visible_cost = $cost;
        $pack->touch ();
        $pack->save ();
        $pack->categories = $categories;
    }

    public function delete ($id)
    {
        $this->packRepository->delete($id);
    }

    public function getPackAutoCompletesPaginate ($page)
    {
        $packautocompletes = $this->packAutoCompleteRepository->getAllPaginate($page);

        return $packautocompletes;
    }

    public function copyPackItemImageAndSaveForAutoComplete ($item)
    {
        if ($item->image)
        {
            $final_file = str_replace ('packs/'.$item->pack_id.'/', 'temp/', $item->image);

            if (Storage::disk('public')->exists($final_file))
                Storage::disk('public')->delete($final_file);

            $file = Storage::disk('public')->copy($item->image, $final_file);

            return $final_file;
        }

        return false;
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