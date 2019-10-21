<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;


class User extends Model
{
    public $timestamps = true;
    use SoftDeletes;
    protected $fillable = ['is_blocked','active','first_name','last_name','email','password','role_id'];

    public function picture()
    {
        return $this->hasOne(Picture::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public static function login($email, $password)
    {
        return DB::table('users as u')
            ->join('pictures as p' ,"u.id","=","p.id")
            ->where(
        [
            ["email",$email],
            ["password",sha1($password)],
            ["active",1],
            ["is_blocked",0],
            ['deleted_at',null]
        ]
            )
          ->get(["u.id","first_name" ,"last_name" ,"email", "token" ,"u.created_at", "deleted_at", "active", "is_blocked", "role_id", "image_name"])
          ->first();
    }

    public static function inactive($email, $password)
    {
            return DB::table('users')->where(
                [
                    ["email",$email],
                    ["password",sha1($password)],
                    ["active",0],
                    ["is_blocked",0],
                    ["deleted_at",null]

                ])->first();
    }

    public static function blocked($email, $password)
    {
        return DB::table('users')->where([
            ["email",$email],
            ["password",sha1($password)],
            ["is_blocked",1],
            ["deleted_at",null]
        ])->first();
    }

    public static function activate($token)
    {
        DB::table('users')
            ->where('token', $token)
            ->update(['active' => 1]);
    }
}
