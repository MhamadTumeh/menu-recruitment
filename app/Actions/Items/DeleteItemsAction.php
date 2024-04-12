<?php

namespace App\Actions\Items;

use App\Repositories\Items\ItemRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteItemsAction
{
    use AsAction;

    private $itemRepository;

    public function __construct(ItemRepositoryInterface $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    public function handle($id)
    {
        $item = $this->itemRepository->find($id);
        $this->itemRepository->delete($item);
    }
}
