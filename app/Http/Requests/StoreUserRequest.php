<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => ['required','max:10'],
            'email' => ['required','email','max:24'],
            'password' => ['required','between:8,16','regex:/^(?=.*[A-Za-z])(?=.*\d).*$/'],
            'password_confirmation' => ['same:password'],
        ];
    }
}
