<?php

namespace App\Http\Controllers;
use App\Model\Picture;
use Exception;
use Illuminate\Database\QueryException;
use App\Http\Requests\RegistrationRequest;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;



class RegisterController extends Controller
{
    public function register(RegistrationRequest $request)
    {
        $first_name = $request->input("firstname");
        $last_name = $request->input("lastname");
        $email = $request->input('email');
        $password = $request->input("password");
        $passwordCheck = $request->input("passwordCheck");
        $image = $request->file("image");
        $image_name = time()."_".$image->getClientOriginalName();
        $token = bcrypt($email.$password);
        $password = sha1($password);


        try {
            if($image->isValid())
                $image->move(public_path("images/"),  $image_name);

            $user = new User;

            $user->first_name = $first_name;
            $user->last_name = $last_name;
            $user->email = $email;
            $user->password = $password;
            $user->token = $token;

            $picture = new Picture;

            $user->save();

            $picture->image_name = $image_name;
            $picture->user_id = $user->id;

            $picture->user()->associate($user)->save();



            return response(null, 201);
        }

        catch(QueryException $e){
            Log::critical($e->getMessage());
            return response(null, 409);
        }

        catch(Exception $e){
            Log::critical($e->getMessage());
            return response(null, 500);
        }
    }
}