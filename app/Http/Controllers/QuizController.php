<?php

namespace App\Http\Controllers;

use App\Model\Answer;
use App\Model\Category;
use App\Model\Question;
use App\Model\Quiz;
use App\Model\Result;
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
        $check = Category::approve(session()->get('user')->id, $category);

        if(count($check))
            return redirect()->back();


        $quiz = Question::with('category')
            ->with(['answers' => function ($a) {
              $a->inRandomOrder();
            }])
            ->where('category_id' , $category)
            ->limit(10)
            ->inRandomOrder()
            ->get();

        if(!count($quiz))
            return redirect()->back()->with('error','error');

//        $quzzies = new Quiz;
//        $quzzies->user_id = session()->get('user')->id;
//        $quzzies->category_id = $category;
//        $quzzies->save();

        return view('pages.quiz')->with('quiz', $quiz);
    }

    public function validation(Request $request){

        $category = $request->post('category');
        $questions = $request->post('questions');
        $answers_ids = $request->post('answers_ids');

        $answers = Answer::all()->whereIn('id',$answers_ids);

        $results = new Result;
        $resultsArray = [];

        for ($i = 0; $i < count($questions); $i++) {
            $resultsArray[] = [
                'user_id' => session()->get('user')->id,
                'answer_id' => $answers_ids[$i],
                'category_id' => $category,
                'question_id' => $questions[$i],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }

        $results->insert($resultsArray);

        return response(['results' => $answers,],200 );
    }
}
