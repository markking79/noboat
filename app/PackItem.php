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

}