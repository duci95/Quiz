<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    public function user()
    {
        return $this->hasOne('CreatePicturesTable');
    }
}
