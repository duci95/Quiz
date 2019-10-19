<?php

namespace App\Http\Controllers\Moderator;

use App\Model\Result;
use App\Model\User;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class StatisticsController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $users = Result::getResultsByCategory($id);
            if($users->items() === [])
                return redirect()->back()->with('empty','empty');
            return view('pages.moderator-statistics-category')->with('users', $users);
        }
        catch(QueryException $e){
            Log::critical($e->getMessage());
            return redirect()->back();
        }
    }

    public function showAll()
    {
        try{
            $results = Result::getAllResults();
            return view('pages.moderator-statistics-users')->with('results', $results);
        }
        catch(QueryException $e){
            Log::critical($e->getMessage());
            return redirect()->back();
        }
    }

    public function showOne($id)
    {
        try{
            $results = Result::getResultsByUser($id);
            return view('pages.moderator-statistics-user-one')->with('results',$results);
        }
        catch(QueryException $e)
        {
            Log::critical($e->getMessage());
            return redirect()->back();
        }
    }
}
