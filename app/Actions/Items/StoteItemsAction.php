<?php

namespace App\Actions\Items;

use App\Http\Requests\ItemRequest;
use App\Repositories\Items\ItemRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class StoteItemsAction
{
    use AsAction;

    private $itemRepository;

    public function __construct(ItemRepositoryInterface $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    public function handle(ItemRequest $request)
    {
       return $this->itemRepository->create($request->validated());

    }
}
