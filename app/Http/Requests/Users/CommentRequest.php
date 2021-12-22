<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'content' => [
                'required',
                'string',
                'min:10',
                'max:1000',
            ],
            'vote' => [
                'required',
                'numeric',
                'min:1',
                'max:5',
            ],
        ];
    }
}
