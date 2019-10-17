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
            ->select('email','first_name','last_name','category_name','r.user_id','image_name',DB::raw('
            COUNT(answer_id) as questions ,
            COUNT(CASE WHEN a.true = 1 THEN 1 ELSE NULL END) as trues'
            ))
            ->join('answers as a','r.answer_id','=','a.id')
            ->join('users as u','r.user_id','=','u.id')
            ->join('pictures as p','u.id','=','p.user_id')
            ->join('categories as c','r.category_id','=','c.id')
            ->where('category_id',$id)
            ->groupBy('email','first_name','last_name','category_name','r.user_id','image_name')
            ->orderBy('last_name')
            ->paginate(10);


    }
    public static function getAllResults()
    {
        return DB::table('results as r')
            ->select('email','first_name','last_name', 'r.user_id','image_name',
                DB::raw('COUNT(category_id) as tests'
            ))
            ->join('categories as c','r.category_id','=','c.id')
            ->join('users as u','r.user_id','=','u.id')
            ->join('pictures as p','u.id','=','p.user_id')
            ->groupBy('email','first_name','last_name','r.user_id','image_name')
            ->orderBy('last_name')
            ->paginate(10);

    }

    public static function getResultsByUser($id)
    {
        return DB::table('results as r')
            ->select('category_name', 'first_name', 'last_name',DB::raw('
            COUNT(answer_id) as questions ,
            COUNT(CASE WHEN a.true = 1 THEN 1 ELSE NULL END) as trues'
            ))
            ->join('answers as a','r.answer_id','=','a.id')
            ->join('categories as c','r.category_id','=','c.id')
            ->join('users as u','r.user_id','=','u.id')
            ->where('user_id',$id)
            ->groupBy('category_name','first_name','last_name')
            ->orderBy('category_name')
            ->paginate(10);
    }
}
