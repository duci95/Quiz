<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Quiz extends Model
{
    public $timestamps = true;
    use SoftDeletes;

    public static function numberOfQuestions($category, $user, $questions)
    {
        return DB::table('quizzes as q')
            ->where('category_id', $category)
            ->where('user_id', $user)
            ->update(['questions' => $questions]);
    }
}
