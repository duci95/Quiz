<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'category' => 'regex:/^[A-ZŠĐŽČĆa-zšđčćž#!?\s0-9-]+$/',
            'desc' => 'regex:/^[A-ZŠĐŽČĆa-zšđčćž#!?0-9-\s]+$/'
        ];
    }
}
