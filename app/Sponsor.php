<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    protected $fillable =
    [
        "flat_id",
        "sponsor_type_id",
        "sponsor_start",
        "sponsor_end"
    ];

    public function flat()
    {
        return $this->belongsTo(Flat::class);
    }

    public function sponsorType()
    {
        return $this->belongsTo(SponsorType::class);
    }
}
