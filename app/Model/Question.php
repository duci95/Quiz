<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Question extends Model
{
    public $timestamps = true;

    public function category()
    {
      return $this->belongsTo(Category::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public static function showTest($category)
    {
        return
            DB::table('categories as c')
            ->join('questions as q','c.id','=','q.category_id')
            ->join('answers as a','q.id', '=','a.question_id')
            ->where('c.category_token','=',$category)
            ->get();
    }

    public static function showQuestions($category)
    {
        return
                DB::table('categories as c')
                ->join('questions as q','c.id','=','q.category_id')
                ->where('c.category_token','=',$category)
                ->get();
    }

}
