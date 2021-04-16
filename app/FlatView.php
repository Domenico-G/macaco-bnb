<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlatView extends Model
{
    public function flat()
    {
        return $this->belongsTo(Flat::class);
    }
}
