<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\AdminUserRequest;
use App\Http\Requests\RegistrationRequest;
use App\Model\Role;
use App\Model\User;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::withoutTrashed()->with('picture')->get();
        $roles = Role::all();
//        dd($users);
                return  view('pages.home')
                    ->with('categories', $users)
                    ->with('roles', $roles);
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

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with('picture')->find($id);
        return response(['results' => $user],200);
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
    public function update(AdminUserRequest $request, $id)
    {
        $first_name = $request->get('firstname');
        $last_name = $request->get('lastname');
        $email = $request->get('email');
        $role = $request->get('role');
        $status = $request->get('status');
        $blocked = $request->get('blocked');
        $password = $request->get('password');
        try {
            $check = User::all()->where('email' , $email)
                ->where('deleted_at','!==',null)
                ->first();

            if(!is_null($check))
                return response(null, 409);

            if (is_null($password)) {
                User::find($id)->update([
                    "first_name" => $first_name,
                    "last_name" => $last_name,
                    "email" => $email,
                    "role" => $role,
                    "status" => $status,
                    "blocked" => $blocked,
                ]);
            } else {
                User::find($id)->update([
                    "first_name" => $first_name,
                    "last_name" => $last_name,
                    "email" => $email,
                    "password" => sha1($password),
                    "role" => $role,
                    "status" => $status,
                    "blocked" => $blocked,
                ]);
            }
        }
        catch(QueryException $e){
            Log::critical($e->getMessage());
            return response(null, 500);
        }
        return response(null,204);
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
