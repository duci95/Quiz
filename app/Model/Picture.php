<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Picture extends Model
{
    protected $fillable = ['image_name'];
    public $timestamps = true;


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
