<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    public $timestamps = true;
    protected $fillable = ['answer','true'];
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function question()
    {
        return $this->belongsToMany(Question::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }
}
