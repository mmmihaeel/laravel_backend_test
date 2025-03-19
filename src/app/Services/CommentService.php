<?php

namespace App\Services;

use App\Models\Comment;
use App\Services\Interfaces\CommentServiceInterface;
use Illuminate\Support\Collection;

class CommentService implements CommentServiceInterface
{
    public function getCommentsByProductId(int $productId): Collection
    {
        return Comment::where('product_id', $productId)->get();
    }

    public function getCommentById(int $id): ?Comment
    {
        return Comment::find($id);
    }

    public function createComment(array $data): Comment
    {
        return Comment::create($data);
    }

    public function updateComment(int $id, array $data): ?Comment
    {
        $comment = Comment::find($id);
        if ($comment) {
            $comment->update($data);
            return $comment;
        }
        return null;
    }

    public function deleteComment(int $id): bool
    {
        $comment = Comment::find($id);
        if ($comment) {
            return $comment->delete();
        }
        return false;
    }
}
