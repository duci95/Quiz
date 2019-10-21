<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
//            "firstname" => "regex:/^([A-ZŠĐČĆŽ][a-zšđčćž\-']{2,20})(\s[A-ZŠĐČĆŽ][a-zšđčćž\-']{2,20})*$/",
//            "lastname" => "regex:/^([A-ZŠĐČĆŽ][a-zšđčćž\-']{2,20})(\s[A-ZŠĐČĆŽ][a-zšđčćž\-']{2,20})*$/",
//            "email" => "email",
//            "password" => "sometimes|regex:/^[A-ZŠĐČĆŽa-zšđčćž?!&^#$%@*0-9]{8,15}$/",
//            "passwordCheck" => "same:password",
//            "image" => "sometimes|mimes:jpeg,jpg,png,gif|max:3000",
//            "role" => "required",
//            "status" => "required",
//            "blocked" => "required"
        ];
    }
}
