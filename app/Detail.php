<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $fillable =
    [
        "flat_id",
        "flat_title",
        "description",
        "image",
        "area_sqm",
        "rooms_quantity",
        "beds_quantity",
        "bathrooms_quantity",
        "price_day",
        "visible"

    ];

    public function flat()
    {
        return $this->belongsTo(Flat::class);
    }

}
