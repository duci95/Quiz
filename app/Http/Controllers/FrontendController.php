<?php

namespace App\Http\Controllers;
use App\Model\Category;
use App\Model\Question;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index($reg  = null)
    {
        return view('pages.log-reg', compact($reg));
    }
    public static function home()
    {
        $categories = Category::all();
        return  view('pages.home')->with('categories', $categories);
    }

}
