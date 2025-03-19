<?php

namespace App\Services\Interfaces;

use App\Models\Product;
use Illuminate\Support\Collection;

interface ProductServiceInterface
{
    public function getAllProducts(array $filters = []): Collection;
    public function getProductById(int $id): ?Product;
    public function createProduct(array $data): Product;
    public function updateProduct(int $id, array $data): ?Product;
    public function deleteProduct(int $id): bool;
}
