<?php

namespace App\Actions\Items;

use App\Repositories\Items\ItemRepositoryInterface;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAllItemsAction
{
    use AsAction;

    private $itemRepository;

    public function __construct(ItemRepositoryInterface $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }
    
    public function handle(Request $request)
    {
        $categoryId = $request->query('category_id');
        $items = $this->itemRepository->all($categoryId);
        return $items;
    }
}
