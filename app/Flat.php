<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Flat extends Model
{
    protected $fillable = [
        "user_id",
        "detail_id",
        "lat",
        "lon",
        "sreet_number",
        "sreet_name",
        "municipality",
        "country_subdivision",
        "postal_code"
    ];


    public function details()
    {
        return $this->hasOne(Detail::class);
        // fare model Detail "belongsTo"
    }

    public function user()
    {
        return $this->belongsTo(User::class);
        // inserire "hasMany" in User
    }

    public function message()
    {
        return $this->hasMany(Message::class);
        // fare model Message "belongsTo"
    }

    public function sponsor()
    {
        return $this->hasMany(Sponsor::class);
        // fare model Sponsor "belongsTo"
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
        // fare model Service "belongsToMany"
    }

    public function view()
    {
        return $this->hasMany(View::class);
        // fare model View "belongsTo"
    }
}
