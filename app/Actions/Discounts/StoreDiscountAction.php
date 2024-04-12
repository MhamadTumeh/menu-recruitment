<?php

namespace App\Actions\Discounts;

use App\Http\Requests\DiscountRequest;
use App\Repositories\Discounts\DiscountRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreDiscountAction
{
    use AsAction;

    private DiscountRepositoryInterface $discountRepository;

    public function __construct(DiscountRepositoryInterface $discountRepository)
    {
        $this->discountRepository = $discountRepository;
    }

    public function handle(DiscountRequest $request)
    {
       $this->discountRepository->create($request->validated());
    }
}
