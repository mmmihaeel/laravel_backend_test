<?php

namespace App\Services\Interfaces;

use App\Models\User;
use Illuminate\Support\Collection;

interface UserServiceInterface
{
    public function getAllUsers(): Collection;
    public function getUserById(int $id): ?User;
    public function createUser(array $data): User;
    public function updateUser(int $id, array $data): ?User;
    public function deleteUser(int $id): bool;
}
