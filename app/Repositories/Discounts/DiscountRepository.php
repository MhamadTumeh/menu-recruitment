<?php

namespace App\Repositories\Discounts;

use App\Http\Requests\DiscountRequest;
use App\Models\Discount;
use App\Repositories\Discounts\DiscountRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class DiscountRepository implements DiscountRepositoryInterface
{
    public function all(): Collection
    {
        return Discount::withTrashed()->get();
    }

    public function find($id): Discount
    {
        return Discount::findOrFail($id);
    }

    public function create(array $data): Discount
    {
        return Discount::create($data);
    }

    public function update(Discount $discount, array $data): Discount
    {
        $discount->update($data);
        return $discount;
    }

    public function delete(Discount $discount): void
    {
        $discount->delete();
    }
}