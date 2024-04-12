<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
    ];

    // protected $appends = ['discount'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // public function discount()
    // {
    //     return $this->morphMany(Discount::class, 'discountable');
    // }

    // public function getDiscountAttribute()
    // {

    //     $discount = null;

    //     // 1. Check for item-specific discounts
    //     $discount = $this->discount()->whereNull('deleted_at')
    //         ->where('end_date', '>=', now())
    //         ->orderBy('percentage', 'desc') // Get the highest discount
    //         ->first();

    //     // 2. If no item-specific discount, check for category discounts
    //     if (!$discount && $this->category) {
    //         $discount = $this->category->discount()->whereNull('deleted_at')
    //             ->where('end_date', '>=', now())
    //             ->orderBy('percentage', 'desc') // Get the highest discount
    //             ->first();
    //     }

    //     // 3. If no item or category discount, check for all-menu discounts
    //     if (!$discount) {
    //         $discount = Discount::whereNull('discountable_type')
    //             ->whereNull('deleted_at')
    //             ->where('end_date', '>=', now())
    //             ->orderBy('percentage', 'desc') // Get the highest discount
    //             ->first();
    //     }

    //     return $discount;
    // }

    // public function discounts()
    // {
    //     return $this->belongsTo(Discount::class,'discountable_id');
    // }

    public function discounts()
    {
        return $this->morphMany(Discount::class, 'discountable');
    }

    public function getPriceAttribute()
    {
        

        if ($this->attributes['price'] !== null) {
            $totalPrice = $this->attributes['price'];
        }

        // Check for item-level discount
        $itemDiscount = $this->discounts()->where('type', 'item')->first();
        if ($itemDiscount) {
            $totalPrice -= $totalPrice * ($itemDiscount->percentage / 100);
        }

        // Check for category/subcategory discount
        $categoryDiscount = $this->category->discounts()->where('type', 'category')->first();
        
        if ($categoryDiscount) {
            $totalPrice -= $totalPrice * ($categoryDiscount->percentage / 100);
        }

        return $totalPrice;
    }
}
