<?php

namespace App\Http\Controllers;

use App\Helpers;
use App\Http\Requests\RecoveryPasswordRequest;
use App\Model\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use function Sodium\randombytes_random16;

class PasswordRecoveryController extends Controller
{
    public function recover(RecoveryPasswordRequest $request)
    {
        $email = $request->input('email');

        $password = sha1(time().$email);
        $password = substr($password, 0, 14);

        try {

            $user = User::all()->where("email", $email)->first();

            if (empty($user))
                return response(null, 404);

            $user = new User;

            $user->where("email", $email)->update(['password' => sha1($password)]);

            $body = "<h5>Nova lozinka : <strong> $password </strong>";
            Helpers::sendMail($email, $body, "Oporavak lozinke");

            return response(null, 204);
        }
        catch (QueryException $e) {
            Log::critical($e->getMessage());
            return response(null, 409);
        }
        catch (Exception $e) {
            Log::critical($e->getMessage());
            return response(null, 500);
        }
    }
}
