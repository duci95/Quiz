<?php

namespace App\Http\Controllers\Moderator;

use App\Model\Answer;
use App\Model\Category;
use App\Model\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionsController extends Controller
{
    public function showOne($id)
    {

        $questions = Question::withoutTrashed()->with(['answers' => function($r){
            $r->withoutTrashed();
    }])->where('category_id','=',$id)->get();

        return view('pages.moderator-questions')
            ->with('questions', $questions)
            ->with('category',$id);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $question = $request->post('question');
        $right = $request->post('right');
        $wrong = $request->post('wrong');
        $category = $request->post('category');

        $q = new Question;
        $q->question = $question;
        $q->category_id = $category;
        $q->save();

        $r = new Answer;

        $r->answer = $right;
        $r->true = 1;
        $r->question_id = $q->id;
        $r->save();

        $w = new Answer;

        $w->answer = $wrong;
        $w->question_id = $q->id;
        $w->save();

        $questions = Question::withoutTrashed()->with(['answers' => function($a){
            $a->withoutTrashed();
        }])->where('category_id','=',$category)->get();

        return response(['results' => $questions], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $question = $request->input('question');
        $category = $request->input('category');

        Question::find($id)->update(['question' => $question]);

        $questions = Question::withoutTrashed()->find($id)->with(['answers' => function($a){
            $a->withoutTrashed();
        }])->where('category_id','=',$category)->get();

        return response(['results' => $questions], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Question::find($id)->delete();
        return response(null, 204);
    }

}
