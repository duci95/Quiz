<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class User extends Model
{
    public $timestamps = true;

    public function pictures()
    {
        return $this->hasMany(Picture::class);
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
            ["is_deleted",0]
        ]
            )
          ->get(["u.id","first_name" ,"last_name" ,"email", "token" ,"u.created_at", "deleted_at", "active", "is_deleted", "role_id", "image_name"])
          ->first();
    }

    public static function inactive($email, $password)
    {
        {
            return DB::table('users')->where(
                [
                    ["email",$email],
                    ["password",sha1($password)],
                    ["active",0],
                    ["is_deleted",0]

                ])->first();
        }
    }

    public static function activate($token)
    {
        DB::table('users')
            ->where('token', $token)
            ->update(['active' => 1]);
    }
}
