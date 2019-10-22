<?php

namespace App\Http\Controllers;

use App\Model\Answer;
use App\Model\Category;
use App\Model\Question;
use App\Model\Quiz;
use App\Model\Result;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class QuizController extends Controller
{
    public function approve($user, $category)
    {
        try {
            $result = Category::approve($user, $category);

            if (count($result) !== 0) {
                $results = Result::getResultForOneTest((session()->get('user')->id), $category);
                return response(['results' => $results], 409);
            }
            return response(null,200);
        }
        catch (QueryException $e){
            Log::critical($e->getMessage());
            return response(null, 500);
        }
    }

    public function test($category)
    {
        try {
            $check = Category::approve(session()->get('user')->id, $category);

            if (count($check))
                return response(null, 403);

            $quiz = Question::with('category')
                ->with(['answers' => function ($a) {
                    $a->inRandomOrder();
                }])
                ->where('category_id', $category)
                ->limit(10)
                ->inRandomOrder()
                ->get();

            if (!count($quiz)) {
                return redirect()->back()->with('error', 'error');
            } else {

                $quzzies = new Quiz;
                $quzzies->user_id = session()->get('user')->id;
                $quzzies->category_id = $category;
                $quzzies->save();

                return view('pages.quiz')->with('quiz', $quiz);
            }
        }
        catch(QueryException $exception){
            Log::critical($exception->getMessage());
            return response(null, 500);
        }
    }

    public function validation(Request $request){

        $category = $request->post('category');
        $questions = $request->post('questions');
        $answers_ids = $request->post('answers_ids');

        try {
            $answers = Answer::all()->whereIn('id', $answers_ids);

            $results = new Result;
            $resultsArray = [];

            for ($i = 0; $i < count($answers_ids); $i++) {
                $resultsArray[] = [
                    'user_id' => session()->get('user')->id,
                    'answer_id' => $answers_ids[$i],
                    'category_id' => $category,
                    'question_id' => $questions[$i],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            }

            Quiz::numberOfQuestions($category, session()->get('user')->id, count($questions));

            $results->insert($resultsArray);

            return response(['results' => $answers], 200);
        }
        catch(QueryException $exception){
            Log::critical($exception->getMessage());
        }
    }
}
