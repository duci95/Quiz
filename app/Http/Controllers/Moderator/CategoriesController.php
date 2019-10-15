<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Requests\CategoryRequest;
use App\Model\Category;
use App\Model\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::withoutTrashed()->get();
        return  view('pages.home')
            ->with('categories', $categories);
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
    public function store(CategoryRequest $request)
    {
        $category_name = $request->post('category');
        $desc = $request->post('desc');

        $unique = Category::withoutTrashed()->where('category_name','=',$category_name)->first();

        if(!is_null($unique))
            return response(null, 422);

        $category = new Category;
        $category->category_name = $category_name;
        $category->description = $desc;
        $category->save();

        $results = Category::withoutTrashed()->get();

        return response(['results' => $results],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $questions = Question::withoutTrashed()->with(['answers' => function($r){
            $r->withoutTrashed();
        }])->where('category_id','=',$id)->get();

        return response(['results'=> $questions],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = Category::find($id);
        return response(['results' => $result],200);
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
        $category = $request->post('category');
        $desc = $request->post('desc');


        Category::find($id)->update([
            'category_name' => $category,
            'description' => $desc
            ]);

        $results = Category::all();
        return response(['results' => $results],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        $results = Category::withoutTrashed()->get();
        return response(['results' => $results],200);
    }
}
