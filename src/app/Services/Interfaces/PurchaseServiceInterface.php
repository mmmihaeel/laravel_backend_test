<?php

namespace App\Services\Interfaces;

use App\Models\Purchase;
use Illuminate\Support\Collection;

interface PurchaseServiceInterface
{
    public function getPurchasesByUserId(int $userId): Collection;
    public function getPurchaseById(int $id): ?Purchase;
    public function createPurchase(array $data): Purchase;
    public function deletePurchase(int $id): bool;
}
