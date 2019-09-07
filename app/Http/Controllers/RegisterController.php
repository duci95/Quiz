<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    public function register(RegistrationRequest $request)
    {
        $firstName = $request->input("firstname");
        $lastname = $request->input("lastname");
        $email = $request->input('email');
        $password = $request->input("password");
        $passwordCheck = $request->input("passwordCheck");
        $image = $request->file("image");
        $imageName = $image->getClientOriginalName();
        $ext = $image->clientExtension();
        dd($ext);

    }
}
