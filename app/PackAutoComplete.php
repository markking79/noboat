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
}
