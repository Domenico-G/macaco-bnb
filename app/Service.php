<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;

class Service extends Model
{
    protected $fillable = ["service_name"];

    public function flats()
    {
        return $this->belongsToMany(Flat::class);
    }

}
