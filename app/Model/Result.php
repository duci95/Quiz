<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Result extends Model
{
    public $timestamps = true;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }

    public static function getResultsByCategory($id)
    {
        return DB::table('results as r')
            ->select('email', 'first_name', 'last_name', 'category_name', 'r.user_id', 'image_name', DB::raw('
            COUNT(CASE WHEN a.true = 1 THEN 1 ELSE NULL END) as trues'
            ))
            ->join('answers as a', 'r.answer_id', '=', 'a.id')
            ->join('users as u', 'r.user_id', '=', 'u.id')
            ->join('pictures as p', 'u.id', '=', 'p.user_id')
            ->join('categories as c', 'r.category_id', '=', 'c.id')
            ->where('c.id', $id)
            ->groupBy('email', 'first_name', 'last_name', 'category_name', 'r.user_id', 'image_name')
            ->orderBy('last_name')
            ->paginate(10);

    }

    public static function getAllResults()
    {
        return DB::table('results as r')
            ->select('email', 'first_name', 'last_name', 'r.user_id', 'image_name')
            ->join('categories as c', 'r.category_id', '=', 'c.id')
            ->join('users as u', 'r.user_id', '=', 'u.id')
            ->join('pictures as p', 'u.id', '=', 'p.user_id')
            ->join('quizzes as q', 'u.id', '=', 'q.user_id')
            ->groupBy('email', 'first_name', 'last_name', 'r.user_id', 'image_name')
            ->orderBy('last_name')
            ->paginate(10);
    }

    public static function getResultsByUser($id)
    {
        return DB::table('results as r')
            ->select('category_name', 'first_name', 'last_name', 'q.questions', DB::raw('
            COUNT(CASE WHEN a.true = 1 THEN 1 ELSE NULL END) as trues'
            ))
            ->join('answers as a', 'r.answer_id', '=', 'a.id')
            ->join('categories as c', 'r.category_id', '=', 'c.id')
            ->join('quizzes as q', 'c.id', '=', 'q.category_id')
            ->join('users as u', 'r.user_id', '=', 'u.id')
            ->where('r.user_id', $id)
            ->groupBy('category_name', 'first_name', 'last_name', 'q.questions')
            ->orderBy('category_name')
            ->paginate(10);
    }

    public static function getResultForOneTest($user, $category)
    {
        return DB::table('results as r')
            ->select('category_name', 'first_name', 'last_name', 'questions', DB::raw('
            COUNT(CASE WHEN a.true = 1 THEN 1 ELSE NULL END) as trues
            '))
            ->join('answers as a', 'r.answer_id', '=', 'a.id')
            ->join('categories as c', 'r.category_id', '=', 'c.id')
            ->join('users as u', 'r.user_id', '=', 'u.id')
            ->join('quizzes as qu', 'r.user_id', '=', 'qu.user_id')
            ->where('u.id', $user)
            ->where('c.id', $category)
            ->groupBy('category_name', 'first_name', 'last_name', 'qu.questions')
            ->get();
    }

    public static function getQuestionsByCategory($category)
    {
        return DB::table('questions as q')
            ->select(DB::raw("COUNT(CASE WHEN q.created_at < qu.created_at THEN 1 ELSE NULL END) as questions"))
            ->join('categories as c', 'q.category_id', '=', 'c.id')
            ->join('quizzes as qu', 'c.id', '=', 'qu.category_id')
            ->where('q.deleted_at', '=', NULL)
            ->where('c.id', $category)
            ->groupBy('category_name')
            ->get();
    }
}
