<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileRequest extends FormRequest
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
            'name' => ['required', 'min: 10', 'max:200', 'string'],
            'email' => ['required', 'max:255', 'email', 'unique:users'],
            'phone' => ['required', 'digits: 10', 'unique:users'],
            'address' => ['required', 'string'],
        ];
    }
}
