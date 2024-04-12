<?php

namespace App\Http\Controllers;

use App\Actions\Items\DeleteItemsAction;
use App\Actions\Items\EditItemsAction;
use App\Actions\Items\GetAllItemsAction;
use App\Actions\Items\StoteItemsAction;
use App\Helpers\ResponseHelper;
use App\Http\Requests\ItemRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    public function getItems(Request $request,GetAllItemsAction $action)
    {
        $items = $action->run($request);
        return ResponseHelper::success($items);
    }

    public function storeItem(ItemRequest $request, StoteItemsAction $action)
    {
        $item = $action->run($request);
        return ResponseHelper::success($item, 'Item created successfully.');
    }

    public function updateItem(ItemRequest $request,EditItemsAction $action, $id)
    {

        try {
            $item =  $action->run($request,$id);
            return ResponseHelper::success($item, 'Item updated successfully.');
        } catch (ModelNotFoundException $e) {
            return ResponseHelper::error('Item not found.', 404);
        }
    }

    public function destroyItem(DeleteItemsAction $action,$id)
    {

        try {
             $action->run($id);
            return ResponseHelper::success(null, 'Item deleted successfully.', 204);
        } catch (ModelNotFoundException $e) {
            return ResponseHelper::error('Item not found.', 404);
        }
    }
}
