<?php

namespace App\Http\Controllers\Moderator;

use App\Model\Answer;
use App\Model\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnswersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $answer = $request->post('answer');
        $category = $request->post('category');
        $question = $request->post('question');

        $a = new Answer();
        $a->question_id = $question;
        $a->answer = $answer;
        $a->save();

        $results = Question::with(['answers' => function($a){
            $a->withoutTrashed();
        }])->where('category_id','=',$category)->get();

        return response(['results'=>$results], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $answer = Answer::find($id);
        return response(['results'=> $answer],200);
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
        $answer = $request->input('answer');
        $category_id = $request->input('category');

        Answer::find($id)->update(['answer'=> $answer]);

        $results = Question::with(['answers' => function($a){
            $a->withoutTrashed();
        }])->where('category_id','=',$category_id)->get();

        return response(['results'=> $results],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Answer::find($id)->delete();
        return response(null,204);
    }
    public function updateTrues(Request $request, $id)
    {
        $question_id = $request->input('question_id');
        $category_id = $request->input('category_id');
        Answer::where('question_id','=', $question_id)->update(['true' => 0]);
        Answer::find($id)->update(['true' => 1]);

        $results = Question::with(['answers' => function($a){
            $a->withoutTrashed();
        }])->where('category_id','=',$category_id)->get();

        return response(['results'=> $results], 200);
    }
}
