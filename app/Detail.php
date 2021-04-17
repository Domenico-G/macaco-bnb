<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $fillable =
    [
        "flat_title",
        "description",
        "image",
        "area_sqm",
        "rooms_quantity",
        "beds_quantity",
        "bathrooms_quantity",
        "price_day"

    ];

    public function flat()
    {
        return $this->belongsTo(Flat::class);
    }

}
