<?php

namespace App\Http\Controllers;

use App\Model\Picture;
use App\Model\User;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;

class UsersController extends Controller
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
        //
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
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $email = $request->input('email');
        $password = $request->input('password');
        $password_again = $request->input('password_again');
        $image = $request->file('image');

        try {

            $check = User::all()->where('email', $email)
                ->where('deleted_at','!==',null)
                ->first();

            if(!is_null($check))
                return response(null, 409);

            if (is_null($password)) {
                User::find($id)->update([
                    "first_name" => $firstname,
                    "last_name" => $lastname,
                    "email" => $email
                ]);
            }

            else {
                User::find($id)->update([
                    "first_name" => $firstname,
                    "last_name" => $lastname,
                    "email" => $email,
                    "password" => sha1($password),
                ]);
            }
            if (!is_null($image)) {
                $image_name = time() . "_" . $image->getClientOriginalName();

                if ($image->isValid()) {
                    $path = public_path('images/' . $image_name);

                    Image::make($image->getRealPath())->resize(75, 75, function ($aspectRatio) {
                        $aspectRatio->aspectRatio();
                    })->save($path, 100);

                    $name = Picture::findOldImage($id);
                    Picture::updateImageForUser($id, $image_name);

                    unlink((public_path('images/' . $name->image_name)));
                }
            }
            return response(null,200);
        }
        catch(QueryException $e) {
            Log::critical($e->getMessage());
            return response(null, 400);
        }
        catch (\Exception $e){
            Log::alert($e->getMessage());
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
        //
    }
}