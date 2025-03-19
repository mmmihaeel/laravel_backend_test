<?php

namespace App\Services\Interfaces;

use App\Models\PurchaseItem;
use Illuminate\Support\Collection;

interface PurchaseItemServiceInterface
{
    public function getPurchaseItemsByPurchaseId(int $purchaseId): Collection;
    public function getPurchaseItemById(int $id): ?PurchaseItem;
    public function createPurchaseItem(array $data): PurchaseItem;
    public function updatePurchaseItem(int $id, array $data): ?PurchaseItem;
    public function deletePurchaseItem(int $id): bool;
}
