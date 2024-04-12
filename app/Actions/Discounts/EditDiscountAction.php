<?php

namespace App\Actions\Discounts;

use App\Http\Requests\DiscountRequest;
use App\Repositories\Discounts\DiscountRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class EditDiscountAction
{
    use AsAction;

    private DiscountRepositoryInterface $discountRepository;

    public function __construct(DiscountRepositoryInterface $discountRepository)
    {
        $this->discountRepository = $discountRepository;
    }

    public function handle(DiscountRequest $request, $id)
    {
        $discount = $this->discountRepository->find($id);
        $discount = $this->discountRepository->update($discount, $request->validated());
        return $discount;
    }
}
