<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SponsorType extends Model
{
    protected $fillable =
    [
        "sponsor_duration",
        "sponsor_price",
        "sponsor_name"
    ];

    public function sponsor()
    {
        return $this->hasMany(Sponsor::class);
    }
}
