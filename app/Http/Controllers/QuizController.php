<?php

namespace App\Http\Controllers;

use App\Model\Category;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function approve($user, $category)
    {
        $quiz = new Category();
        $result = $quiz->approve($user, $category);
        return response(['data' => $result],200);
    }
    public static function test(Request $request)
    {
        $user = session()->get('user')->id;
        $category = $request->post('category');

        return redirect()->route('');
    }
    public static function show()
    {

    }
}
