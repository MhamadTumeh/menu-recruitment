<?php

namespace App\Actions\Categories;

use App\Repositories\Categories\CategoryRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class GetCategoriesAction
{
    use AsAction;

    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    
    public function handle($id)
    {
        $category = $this->categoryRepository->find($id);
        return $category;
    }
}
