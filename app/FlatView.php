<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlatView extends Model
{
    protected $fillable =
    [
        "flat_id",
        "viewer_ip"
    ];

    public function flat()
    {
        return $this->belongsTo(Flat::class);
    }
}
