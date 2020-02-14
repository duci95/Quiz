<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Picture extends Model
{
    protected $fillable = ['image_name'];
    public $timestamps = true;


    public static function updateImageForUser($user_id, $image_name)
    {
        DB::table('pictures')
            ->where('user_id',$user_id)
            ->update(['image_name' => $image_name]);
    }

    public static function findOldImage($user_id)
    {
     return  DB::table('pictures')
            ->where('user_id',$user_id)
            ->first();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
