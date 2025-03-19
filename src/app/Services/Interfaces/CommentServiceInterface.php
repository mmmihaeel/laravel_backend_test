<?php

namespace App\Services\Interfaces;

use App\Models\Comment;
use Illuminate\Support\Collection;

interface CommentServiceInterface
{
    public function getCommentsByProductId(int $productId): Collection;
    public function getCommentById(int $id): ?Comment;
    public function createComment(array $data): Comment;
    public function updateComment(int $id, array $data): ?Comment;
    public function deleteComment(int $id): bool;
}
