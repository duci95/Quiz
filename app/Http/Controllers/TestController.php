<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Question;
use Illuminate\Http\Request;

class TestController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        $check = Category::approve(session()->get('user')->id, $id);
//
//                if(count($check))
//                    return redirect()->back();
//
//
//                $quiz = Question::with('category')
//                    ->with(['answers' => function ($a) {
//                      $a->inRandomOrder();
//                    }])
//                    ->where('category_id' , $id)
//                    ->limit(10)
//                    ->inRandomOrder()
//                    ->get();
//
//                if(!count($quiz))
//                    return redirect()->back()->with('error','error');
//
//                $quzzies = new Quiz;
//                $quzzies->user_id = session()->get('user')->id;
//                $quzzies->category_id = $id;
//                $quzzies->save();
//
//                return view('pages.quiz')->with('quiz', $quiz);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
