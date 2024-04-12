<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|integer|exists:categories,id',
        ];
    }



    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $categoryId = $this->input('category_id');
            $category = Category::find($categoryId);

            if ($category && $category->subcategories->isNotEmpty()) {
                $validator->errors()->add('category_id', 'Category or subcategory cannot have mixed children (subcategories or items).');
            }
        });
    }
}
