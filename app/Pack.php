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
        return $this->hasOne(PackSeason::class, 'id', 'pack_season_id');
    }

    public function items ()
    {
        return $this->hasMany(PackItem::class);
    }

    public function likes()
    {
        return $this->belongsToMany('App\User', 'pack_likes', 'pack_id', 'user_id')->withTimestamps();
    }

    public function getVisibleImperialAttribute ()
    {
        return round ($this->visible_ounces / 16, 1) . ' lb.';
    }

    public function getVisibleMetricAttribute ()
    {
        return round ($this->visible_ounces / 35.27, 1) . ' kg.';
    }

    public function getLoginUserLikedAttribute ()
    {
        if (!auth()->check())
            return false;

        $liked = $this->likes->where ('id', auth()->user()->id)->first ();
        if ($liked)
            return true;

        return false;
    }

    public function desired_weight_format ($metric = 'Imperial')
    {
        if ($metric == 'Imperial')
            return $this->visible_imperial;
        else
            return $this->visible_metric;
    }

}
