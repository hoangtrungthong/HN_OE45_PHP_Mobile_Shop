<?php

namespace App\Http\Requests\Category;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class UpdateRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $slug = Str::slug($request->name);
        $category = Category::whereSlug($slug)->first();

        return [
            'name' => [
                'required',
                'string',
                'min:5',
                'max:255',
                Rule::unique('categories')->ignore($category),
            ],
            'parent' => [
                'required',
                'numeric',
            ],
        ];
    }
}
