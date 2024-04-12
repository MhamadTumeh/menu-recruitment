<?php

namespace App\Repositories\Categories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function all(): Collection
    {
        return Category::rootCategories()->with('subcategories', 'subcategories.items', 'discounts', 'subcategories.discounts', 'subcategories.items.discounts')->get();
    }

    public function leafSubCategories(): Collection
    {
        return Category::leafCategories()->get();
    }

    public function find($id): Category
    {
        return Category::findOrFail($id);
    }

    public function create(array $data): Category
    {
        $parent_id = null;
        if (isset($data['parent_id']) && $data['parent_id']) {
            $parent_id = $data['parent_id'];
        }
        return Category::createValidSubcategory($data, $parent_id);
    }

    public function update(Category $category, $data): Category
    {
        $category->update($data);
        return $category;
    }

    public function delete(Category $category): void
    {
        $category->delete();
    }
}
