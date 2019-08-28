<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackAutoComplete extends Model
{
    protected $fillable = [
        'name',
        'description',
        'purchase_link',
        'image',
        'price',
        'ounces'
    ];

    public function getImperialEachAttribute ()
    {
        return round ($this->ounces / 16, 1) . ' lb.';
    }

    public function getMetricEachAttribute ()
    {
        return round ($this->ounces / 35.27, 1) . ' kg.';
    }

    public function desired_weight_format ($metric = 'imperial')
    {
        if ($metric == 'imperial')
            return $this->imperial_each;
        else
            return $this->metric_each;
    }
}
