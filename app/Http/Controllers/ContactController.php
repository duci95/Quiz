<?php

namespace App\Http\Controllers;

use App\Helpers;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function send(ContactRequest $request)
    {
        $email = $request->post('email');
        $text = $request->post('text');

        try{
            Helpers::sendMail(Helpers::$email,$text,$email);
            return response(null,200);
        }
        catch(\Exception $e){
            Log::critical($e->getMessage());
            return response(null,400);
        }
    }
}
