<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Question;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function approve($user, $category)
    {
        $result = Category::approve($user, $category);

        if(count($result) !== 0)
            return response(null, 409);

        return response(null,200);
    }

    public function test($category)
    {
        $quiz = Question::with('category')
            ->with('answers')
            ->where('category_id' , $category)
            ->get();

//        dd($quiz);

        $check = Category::approve(session()->get('user')->id, $category);

        if(count($check))
            return redirect()->back();

//        if(!count($quiz))
//            return response(null, 404);

        return view('pages.quiz')->with('quiz', $quiz);
    }
}
