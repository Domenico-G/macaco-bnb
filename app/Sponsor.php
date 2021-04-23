<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    public function flat()
    {
        return $this->belongsTo(Flat::class);
    }

    public function sponsorType()
    {
        return $this->belongsTo(SponsorType::class);
    }
}
