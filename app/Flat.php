<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Flat extends Model
{
    protected $fillable = [
        "street_number",
        "street_name",
        "municipality",
        "country_secondary_subdivision",
        "country_subdivision",
        "visible",
        "postal_code"
    ];


    public function details()
    {
        return $this->hasOne(Detail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function sponsor()
    {
        return $this->hasMany(Sponsor::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);

    }

    public function flatViews()
    {
        return $this->hasMany(FlatView::class);
    }
}
