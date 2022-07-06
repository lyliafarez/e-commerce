<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return transliterator_create_from_rules;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required | max:255',
            'description' => 'required',
            'category' => 'required',
            'price' => 'required',
            'ref' => 'requied',
            'image' =>'required | mimes:jpg,png,jpeg |max:5048',
        ];
    }
}
