<?php

namespace App\Http\Controllers;
use App\Helpers;
use App\Model\Picture;
use Exception;
use Illuminate\Database\QueryException;
use App\Http\Requests\RegistrationRequest;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
use PHPMailer\PHPMailer\PHPMailer;


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
        $token = sha1(time().$email.$password);
        $password = sha1($password);


        try {
            if($image->isValid())
               $path = public_path('images/' . $image_name);


            Image::make($image->getRealPath())->resize(75,75,function ($aspectRatio) {
                 $aspectRatio->aspectRatio();
            })->save($path,100);


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

            $body = 'Klinkite na <a href="http://127.0.0.1:8000/activation/' . $token . '" >link</a> da aktivirate profil';

            Helpers::sendMail($email, $body, "Registracija");

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

    public function activation($token)
    {
       try {
            User::activate($token);
            return redirect("/")->with("activated","activated");
       }
       catch(QueryException $e) {
           Log::critical("Error while activating user with token: $token , caused by ". $e->getMessage());
           return redirect()->back();
       }
    }
}
