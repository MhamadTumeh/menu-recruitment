<?php

namespace App\Http\Controllers;

use App\Actions\Categories\DeleteCategoriesAction;
use App\Actions\Categories\EditCategoriesAction;
use App\Actions\Categories\GetAllCategoriesAction;
use App\Actions\Categories\GetAllSubCategoriesAction;
use App\Actions\Categories\GetCategoriesAction;
use App\Actions\Categories\StoteCategoriesAction;
use App\Helpers\ResponseHelper;
use App\Http\Requests\CategoryRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryController extends Controller
{
    public function getCategories(GetAllCategoriesAction $action)
    {
        $categories = $action->run();
        return ResponseHelper::success($categories);
    }


    public function getLeafSubCategories(GetAllSubCategoriesAction $action)
    {
        $categories = $action->run();
        return ResponseHelper::success($categories);
    }


    public function getCategory(GetCategoriesAction $action, $id)
    {
        $category = $action->run($id);
        return ResponseHelper::success($category);
    }


    public function storeCategory(CategoryRequest $rquest,StoteCategoriesAction $action)
    {
        $category = $action->run($rquest);
        return ResponseHelper::success($category, 'Category created successfully.');
    }

    public function updateCategory(CategoryRequest $rquest,EditCategoriesAction $action, $id)
    {
        try {
            $category = $action->run($rquest,$id);
            return ResponseHelper::success($category, 'Category updated successfully.');
        } catch (ModelNotFoundException $e) {
            return ResponseHelper::error('Category not found.', 404);
        }
    }

    public function destroyCategory(DeleteCategoriesAction $action, $id)
    {
        try {
            $action->run($id);
            return ResponseHelper::success(null, 'Category deleted successfully.', 204);
        } catch (ModelNotFoundException $e) {
            return ResponseHelper::error('Category not found.', 404);
        }
    }
}
