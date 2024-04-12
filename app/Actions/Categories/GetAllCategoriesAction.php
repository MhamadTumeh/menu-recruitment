<?php

namespace App\Actions\Categories;

use App\Repositories\Categories\CategoryRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAllCategoriesAction
{
    use AsAction;

    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function handle()
    {
        return $this->categoryRepository->all();
    }
}
