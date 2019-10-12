<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    public $timestamps = true;

    private $image_name;
    private $user_id;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
