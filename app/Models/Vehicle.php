<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        "name",
        "model",
        "release_model",
        "release_year",
        "color",
        "km",
        "description",
        "price",
        "brand_id",
        "status_id",
        "image",
        "user_id"
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
