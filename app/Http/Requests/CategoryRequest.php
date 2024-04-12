<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:categories,name',
            'parent_id' => 'nullable|integer|exists:categories,id',
        ];
    }

    public function authorize()
    {
        return true;
    }

    // public function withValidator($validator)
    // {
    //     $validator->after(function ($validator) {
    //         if ($this->has('parent_id') && $this->parent_id) {
    //             $parent = Category::find($this->parent_id);
    //             $data = $this->all();
    //             Category::createValidSubcategory($data, $this->parent_id);
    //         }
    //     });
    // }

}
