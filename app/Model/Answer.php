<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public $timestamps = true;

    public function question()
    {
        return $this->belongsToMany(Question::class);
    }

}
