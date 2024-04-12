<?php

namespace App\Actions\Categories;

use App\Repositories\Categories\CategoryRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAllSubCategoriesAction
{
    use AsAction;

    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    
    public function handle()
    {
        $categories = $this->categoryRepository->leafSubCategories();
        return $categories;
    }
}
