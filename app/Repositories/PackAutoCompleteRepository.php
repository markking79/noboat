<?php

namespace App\Repositories;

use App\PackAutoComplete;
use Illuminate\Support\Facades\Cache;

class PackAutoCompleteRepository implements PackAutoCompleteRepositoryInterface
{

    private $secondsCache = 1;

    function __construct()
    {
        $this->secondsCache = config('custom.seconds_database_cache');
    }

    public function getAllPaginate ($page)
    {
        $data = Cache::tags('packautocompletes')->remember('packautocompletes-'.$page, $this->secondsCache, function () use ($page) {

            return PackAutoComplete::paginate(21);
        });

        return $data;

    }

    public function search ($terms)
    {
        $data = Cache::tags('packautocompletes')->remember('packautocompletes-'.$terms, $this->secondsCache, function () use ($terms) {

            $termsArray = explode(' ', $terms);
            if (!$termsArray)
                return null;

            $whereArray = array();
            foreach ($termsArray as $term)
                $whereArray[] = ['name', 'LIKE', "%$term%"];

            return Packautocomplete::where($whereArray)->get(['id', 'name', 'purchase_link', 'image', 'price', 'ounces']);
        });

        return $data;
    }

    public function delete ($id)
    {
        PackAutoComplete::destroy($id);
    }

    public function clearCache ()
    {
        Cache::tags('packautocompletes')->flush();
    }

}