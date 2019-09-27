<?php

namespace App\Http\Controllers;

use App\Helpers;
use App\Http\Requests\RecoveryPasswordRequest;
use App\Model\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PasswordRecoveryController extends Controller
{
    public function recover(RecoveryPasswordRequest $request)
    {
        $email = $request->input('email');

        $password = bcrypt(time());
        $password = substr($password, 0,15);

    try{
        $user = new User;
        $a = User::all()->find($user->id);

        dd($a);

        $body = `<h5>Nova lozinka : <strong> $password </strong>`;

        Helpers::sendMail($email, $body, "Oporavak lozinke");

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
