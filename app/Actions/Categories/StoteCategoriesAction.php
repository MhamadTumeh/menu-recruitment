<?php

namespace App\Actions\Categories;

use App\Http\Requests\CategoryRequest;
use App\Repositories\Categories\CategoryRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class StoteCategoriesAction
{
    use AsAction;
    protected $categoryRepository;
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function handle(CategoryRequest $request)
    {
        $category = $this->categoryRepository->create($request->validated());
        return $category;
    }
}
