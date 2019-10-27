<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\AdminUserRequest;
use App\Http\Requests\RegistrationRequest;
use App\Model\Picture;
use App\Model\Role;
use App\Model\User;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $users = User::withoutTrashed()->with('picture')->get();
            $roles = Role::all();
            return view('pages.home')
                ->with('categories', $users)
                ->with('roles', $roles);
        }
        catch(QueryException $q){
            Log::critical($q->getMessage());
            return response(null, 400);
        }
        catch (\Exception $e){
            Log::alert($e->getMessage());
            return response(null, 500);
        }
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
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $email = $request->input('email');
        $password = $request->input('password');
        $password_again = $request->input('password_again');
        $role = $request->input('role');
        $active = $request->input('active');
        $blocked = $request->input('blocked');
        $image = $request->file('image');

        $image_name = time()."_".$image->getClientOriginalName();
        $token = sha1(time().$email.$password);
        $password = sha1($password);
        try {
            if ($image->isValid()) {
                $path = public_path('images/' . $image_name);

                Image::make($image->getRealPath())->resize(60, 60)->save($path, 100);
            }

            $u = new User;
            $u->first_name = $firstname;
            $u->last_name = $lastname;
            $u->email = $email;
            $u->password = $password;
            $u->role_id = $role;
            $u->active = $active;
            $u->is_blocked = $blocked;
            $u->token = $token;
            $u->save();

            $p = new Picture;
            $p->image_name = $image_name;
            $p->user_id = $u->id;
            $p->save();

            $users = User::withoutTrashed()->with('picture')->get();
            return response(['results' => $users],200);
        }
        catch(QueryException $e){
            Log::critical($e->getMessage());
            return response(null, 400);
        }
        catch(\Exception $e){
            Log::alert($e->getMessage());
            return response(null, 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $user = User::with('picture')->find($id);
            return response(['results' => $user],200);
        }
        catch(QueryException $e){
            Log::critical($e->getMessage());
            return response(null,400);
        }
        catch(\Exception $e){
            Log::alert($e->getMessage());
            return response(null ,500);
        }

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
        $first_name = $request->input('firstname');
        $last_name = $request->input('lastname');
        $email = $request->input('email');
        $role = $request->input('role');
        $status = $request->input('active');
        $blocked = $request->input('blocked');
        $password = $request->input('password');
        $image = $request->file('image_new');
        $old = $request->input('image_old');

        try {
            if(!is_null($image)) {
                $image_name = time()."_".$image->getClientOriginalName();

                if ($image->isValid()) {
                    $path = public_path('images/' . $image_name);

                    Image::make($image->getRealPath())->resize(60, 60)->save($path, 100);

                    $oldArray = Picture::find($old)->attributesToArray();
                    $name = $oldArray['image_name'];

                    Picture::find($old)->update(['image_name' => $image_name]);

                    $d = unlink((public_path('images/' . $name)));

                }
            }

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
                    "role_id" => $role,
                    "active" => $status,
                    "is_blocked" => $blocked
                ]);
            } else {
                User::find($id)->update([
                    "first_name" => $first_name,
                    "last_name" => $last_name,
                    "email" => $email,
                    "password" => sha1($password),
                    "role_id" => $role,
                    "active" => $status,
                    "is_blocked" => $blocked
                ]);

            }
            $results = User::withoutTrashed()->with('picture')->get();
            return response(['results' => $results],200);
        }
        catch(QueryException $e) {
            Log::critical($e->getMessage());
            return response(null, 400);
        }
        catch (\Exception $e){
            Log:alert($e->getMessage());
            return response(null ,500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            User::find($id)->delete();
            $results = User::withoutTrashed()->with('picture')->get();
            return response(['results' => $results],200);
        }
        catch(QueryException $q){
            Log::critical($q->getMessage());
            return response(null,400);
        }
        catch (\Exception $e) {
            Log::alert($e->getMessage());
            return response(null, 500);
        }
    }
}
