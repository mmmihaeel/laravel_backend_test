<?php

namespace App\Services;

use App\Models\Purchase;
use App\Services\Interfaces\PurchaseServiceInterface;
use Illuminate\Support\Collection;

class PurchaseService implements PurchaseServiceInterface
{
    public function getPurchasesByUserId(int $userId): Collection
    {
        return Purchase::where('user_id', $userId)->get();
    }

    public function getPurchaseById(int $id): ?Purchase
    {
        return Purchase::find($id);
    }

    public function createPurchase(array $data): Purchase
    {
        return Purchase::create($data);
    }

    public function deletePurchase(int $id): bool
    {
        $purchase = Purchase::find($id);
        if ($purchase) {
            return $purchase->delete();
        }
        return false;
    }
}
