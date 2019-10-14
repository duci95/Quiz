<?php

namespace App\Http\Controllers;

use App\Helpers;
use App\Http\Requests\LoginRequest;
use App\Model\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        try {
            $user = User::login($email, $password);

            if($user){
                $request->session()->put('user', $user);

                if(session()->get('user')->role_id === 1)
                    return response(null, 201);

                if(session()->get('user')->role_id === 2)
                    return response(null, 202);

                if(session()->get('user')->role_id === 3)
                    return response(null, 203);

            }
            else if(!$user){
                 $inactive = User::inactive($email, $password);
                 if($inactive) {
                     $body = 'Kliknite na <a href="http://127.0.0.1:8000/activation/' . $inactive->token . '" >link</a> da aktivirate profil';
                     Helpers::sendMail($email, $body, "Registracija");
                     return response(null, 403);
                 }
            }
            return response(null, 404);
        }
        catch(QueryException $sql){
            Log::critical($sql->getMessage());
            return response(null, 500);
        }
    }
    public function logout(Request $request)
    {
        $request->session()->forget('user');
        $request->session()->flush();
        return redirect()->route('log-reg');
    }
}
