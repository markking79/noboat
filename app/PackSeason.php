<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackSeason extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'weight'
    ];

    public function pack()
    {
        return $this->belongsTo(Pack::class);
    }

}
