<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'parent_id', 'depth'];

    // protected $appends = ['discount'];

    public function subcategories(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }


    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }


    public function discounts()
    {
        return $this->morphMany(Discount::class, 'discountable');
    }


    public function scopeRootCategories($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeLeafCategories(Builder $query)
    {
        return $query->whereDoesntHave('subcategories')->whereDoesntHave('items');
    }


    public function validateChildren($children)
    {
        foreach ($children as $child) {
            if (!($child instanceof Category || $child instanceof Item)) {
                throw new \Exception('Invalid child type for category');
            }
        }
    }

    public static function createValidSubcategory(array $data, $parentId = null)
    {
        if (!$data['name']) {
            throw new \InvalidArgumentException('Subcategory name is required.');
        }


        $depth = $parentId ? (Category::where('id', $parentId)->first()->depth + 1 ?? 1) : 1;

        if (!static::validateDepth($depth, $parentId)) {
            throw new \InvalidArgumentException('Maximum subcategory depth exceeded or invalid parent category.');
        }

        if ($parentId) {
            $parent = Category::find($parentId);
            if ($parent->subcategories->count() > 0 && $parent->items->count() > 0) {
                throw new \InvalidArgumentException('Category or subcategory cannot have mixed children (subcategories or items).');
            }
        }

        $subcategory = new Category();
        $subcategory->name = $data['name'];
        $subcategory->parent_id = $parentId;
        $subcategory->depth = $depth;
        $subcategory->save();

        return $subcategory;
    }

    public static function validateDepth($depth, $parentId = null): bool
    {

        if ($depth > 4) {
            return false;
        }

        if ($parentId && Category::where('id', $parentId)->count() === 0) {
            return false;
        }

        return true;
    }
}
