<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pack extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pack_season_id',
        'name',
        'image',
        'heart_count',
        'visible_item_count',
        'visible_ounces',
        'visible_cost',
        'is_visible'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function season()
    {
        return $this->hasOne(PackSeason::class);
    }

}
