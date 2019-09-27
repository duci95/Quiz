<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User extends Model
{
    private $first_name;
    private $last_name;
    private $email;
    private $password;
    private $token;


    public $timestamps = true;

    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }

    public function login()
    {
        return DB::table('users')->where(
        [
            ["email",$this->email],
            ["password",bcrypt($this->password)],
            ["active",1],
            ["is_deleted",0]

        ])->first();
    }

    public static function activate($token)
    {
        DB::table('users')
            ->where('token', $token)
            ->update(['active' => 1]);
    }
}