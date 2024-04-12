<?php

namespace App\Actions\Discounts;

use App\Repositories\Discounts\DiscountRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAllDiscountAction
{
    use AsAction;

    private DiscountRepositoryInterface $discountRepository;

    public function __construct(DiscountRepositoryInterface $discountRepository)
    {
        $this->discountRepository = $discountRepository;
    }
    
    public function handle()
    {
        return $this->discountRepository->all();
    }
}
