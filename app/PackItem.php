<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'purchase_link',
        'image',
        'ounces_each',
        'cost_each',
        'quantity',
        'weight'
    ];

    public function pack()
    {
        return $this->belongsTo(Pack::class);
    }

    public function category()
    {
        return $this->hasOne(PackCategory::class);
    }

    public function getImperialEachAttribute ()
    {
        return round ($this->ounces_each / 16, 1) . ' lb.';
    }

    public function getMetricEachAttribute ()
    {
        return round ($this->ounces_each / 35.27, 1) . ' kg.';
    }

    public function desired_weight_format ($metric = 'Imperial')
    {
        if ($metric == 'Imperial')
            return $this->imperial_each;
        else
            return $this->metric_each;
    }

}