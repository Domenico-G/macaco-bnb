<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable =
    [
        "flat_id",
        "sender_mail",
        "sender_name",
        "sender_surname",
        "message_content",
    ];


   public function flat()
    {
        return $this->belongsTo(Flat::class);

    }
}
