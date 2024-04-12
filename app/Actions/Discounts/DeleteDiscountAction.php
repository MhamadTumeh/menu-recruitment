<?php

namespace App\Actions\Discounts;

use App\Repositories\Discounts\DiscountRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteDiscountAction
{
    use AsAction;

    private DiscountRepositoryInterface $discountRepository;

    public function __construct(DiscountRepositoryInterface $discountRepository)
    {
        $this->discountRepository = $discountRepository;
    }

    public function handle($id)
    {
        $discount = $this->discountRepository->find($id);
        $this->discountRepository->delete($discount);
    }
}
