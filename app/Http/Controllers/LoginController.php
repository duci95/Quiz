<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Model\User;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = new User;


        $user->login();
    }

}
