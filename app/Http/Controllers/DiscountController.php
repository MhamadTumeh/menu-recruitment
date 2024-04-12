<?php

namespace App\Http\Controllers;

use App\Actions\Discounts\DeleteDiscountAction;
use App\Actions\Discounts\EditDiscountAction;
use App\Actions\Discounts\GetAllDiscountAction;
use App\Actions\Discounts\StoreDiscountAction;
use App\Helpers\ResponseHelper;
use App\Http\Requests\DiscountRequest;

class DiscountController extends Controller
{

    public function getDiscounts(GetAllDiscountAction $action)
    {
        $discounts = $action->run();
        return ResponseHelper::success($discounts);
    }

    public function storeDiscount(DiscountRequest $request, StoreDiscountAction $action)
    {
        $discount = $action->run($request);
        return ResponseHelper::success($discount, 'Discount created successfully.', 201);
    }

    public function updateDiscount(DiscountRequest $request, EditDiscountAction $action, $id)
    {
        $discount =  $action->run($request, $id);
        return ResponseHelper::success($discount, 'Discount updated successfully.');
    }

    public function destroyDiscount(DeleteDiscountAction $action, $id)
    {
        $action->run($id);
        return ResponseHelper::success(null, 'Discount deleted successfully.', 204);
    }
}
