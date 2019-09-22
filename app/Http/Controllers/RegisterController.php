<?php

namespace App\Http\Controllers;
use App\Model\Picture;
use Illuminate\Database\QueryException;
use App\Http\Requests\RegistrationRequest;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;



class RegisterController extends Controller
{
    public function register(RegistrationRequest $request)
    {
        $user = new User();

        $firstName = $request->input("firstname");
        $lastName = $request->input("lastname");
        $email = $request->input('email');
        $password = $request->input("password");
        $password = sha1($password);
        $passwordCheck = $request->input("passwordCheck");
        $image = $request->file("image");
        $imageName = time()."_".$image->getClientOriginalName();
        try {
            if($image->isValid())
                $image->move(public_path("images/"),  $imageName);

            $user = new User();
            $user->setFirstName($firstName);
            $user->setLastName($lastName);
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setCreatedAt(date('d-m-Y H:i:s'));

            
            $user->save();

        }


        catch(QueryException $e){
            Log::critical("Server is under construction, please try later");
            return response(500, null);
        }

    }
}
