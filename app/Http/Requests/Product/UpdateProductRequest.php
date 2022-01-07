<?php

namespace App\Http\Requests\Product;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'min:5',
                'max:255',
                Rule::unique('products')->ignore($this->product),
            ],
            'category_id' => [
                'required',
                'numeric',
                'exists:categories,id',
            ],
            'color_id.*' => [
                'required',
                'exists:colors,id',
            ],
            'memory_id.*' => [
                'required',
                'exists:memories,id',
            ],
            'quantity.*' => [
                'required',
                'min:1',
                'max:50',
            ],
            'price.*' => [
                'required',
                'min:1',
                'max:50',
            ],
            'content' => [
                'required',
                'string',
                'min:50',
                'max:4000',
            ],
            'specifications' => [
                'required',
                'string',
                'min:50',
                'max:4000',
            ],
            'images.*' => [
                'required',
                'mimes:jpg,jpeg,png,JPG,JPEG,PNG',
                'max:5120',
            ],
        ];
    }
}
