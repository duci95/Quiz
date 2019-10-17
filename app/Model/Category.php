<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
class Category extends Model
{
    use SoftDeletes;
    protected $fillable = ['category_name', 'description'];
    public $timestamps = true;
    protected $dates = ['deleted_at'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
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
