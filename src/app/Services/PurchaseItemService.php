<?php

namespace App\Services;

use App\Models\PurchaseItem;
use App\Services\Interfaces\PurchaseItemServiceInterface;
use Illuminate\Support\Collection;

class PurchaseItemService implements PurchaseItemServiceInterface
{
    public function getPurchaseItemsByPurchaseId(int $purchaseId): Collection
    {
        return PurchaseItem::where('purchase_id', $purchaseId)->get();
    }

    public function getPurchaseItemById(int $id): ?PurchaseItem
    {
        return PurchaseItem::find($id);
    }

    public function createPurchaseItem(array $data): PurchaseItem
    {
        return PurchaseItem::create($data);
    }

    public function updatePurchaseItem(int $id, array $data): ?PurchaseItem
    {
        $purchaseItem = PurchaseItem::find($id);
        if ($purchaseItem) {
            $purchaseItem->update($data);
            return $purchaseItem;
        }
        return null;
    }

    public function deletePurchaseItem(int $id): bool
    {
        $purchaseItem = PurchaseItem::find($id);
        if ($purchaseItem) {
            return $purchaseItem->delete();
        }
        return false;
    }
}
