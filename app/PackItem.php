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
        'pack_id',
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

    public function getGramsEachAttribute ()
    {
        return round ($this->ounces_each * 28, 0) . ' g.';
    }

    public function getImperialEachAttribute ()
    {
        return round ($this->ounces_each / 16, 1) . ' lb.';
    }

    public function getMetricEachAttribute ()
    {
        return round ($this->ounces_each / 35.27, 1) . ' kg.';
    }

    public function desired_weight_format ($metric = 'imperial')
    {
        if ($metric == 'imperial')
            return $this->imperial_each;
        else
            return $this->metric_each;
    }

    public function small_desired_weight_format ($metric = 'imperial')
    {
        if ($metric == 'imperial')
            return $this->grams_each;
        else
            return $this->ounces_each . ' oz.';
    }

}