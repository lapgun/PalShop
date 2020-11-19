<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => ['required', 'max:36'],
            'model' => ['required', 'max:36'],
            'image' => ['mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'description' => ['required'],
            'weight' => ['required', 'max:16'],
            'size' => ['required', 'max:16'],
            'quality' => ['required', 'max:16'],
            'price' => ['required', 'max:36'],
        ];
    }
}
