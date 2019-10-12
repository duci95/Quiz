<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    public $timestamps = true;

    public function questions()
    {
        return $this->hasMany(Question::class);
    }


    public static function approve($user, $category)
    {
        return DB::table('quizzes as q')
            ->join("categories as c",'q.category_id','=','c.id')
            ->where([
                'user_id' => $user,
                'c.id' => $category
            ])
            ->get();
    }
}
