<?php

namespace App\Actions\Categories;

use App\Http\Requests\CategoryRequest;
use App\Repositories\Categories\CategoryRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class EditCategoriesAction
{
    use AsAction;

    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function handle(CategoryRequest $request, $id)
    {
        $category = $this->categoryRepository->find($id);
        $category = $this->categoryRepository->update($category, $request->validated());
        return $category;
    }
}
