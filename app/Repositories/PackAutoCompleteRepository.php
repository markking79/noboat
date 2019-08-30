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

            return PackAutoComplete::orderBy('created_at', 'desc')->paginate(21);
        });

        return $data;

    }

    public function getById ($id)
    {
        $data = Cache::tags('packautocompletes')->remember('packautocompletesitem-'.$id, $this->secondsCache, function () use ($id) {

            return PackAutoComplete::find($id);
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

            return Packautocomplete::where($whereArray)->orderBy('created_at', 'desc')->get(['id', 'name', 'purchase_link', 'image', 'price', 'ounces']);
        });

        return $data;
    }

    public function store ($values)
    {
        $item = Packautocomplete::create ($values);
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

    public function delete ($id)
    {
        PackAutoComplete::destroy($id);
    }

    public function clearCache ()
    {
        Cache::tags('packautocompletes')->flush();
    }

}