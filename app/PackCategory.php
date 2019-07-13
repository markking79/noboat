<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackCategory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'weight',
        'is_visible',
        'include_in_base_weight',
        'include_in_pack_weight'
    ];

    public function pack()
    {
        return $this->belongsTo(Pack::class);
    }

    public function getImperialWeightAttribute ()
    {
        return round ($this->total_ounces / 16, 1) . ' lb.';
    }

    public function getMetricWeightAttribute ()
    {
        return round ($this->total_ounces / 35.27, 1) . ' kg.';
    }

    public function desired_weight_format ($metric = 'Imperial')
    {
        if ($metric == 'Imperial')
            return $this->imperial_weight;
        else
            return $this->metric_weight;
    }
}