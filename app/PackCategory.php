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
}