<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Services\Interfaces\CommentServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentServiceInterface $commentService)
    {
        $this->commentService = $commentService;
        $this->middleware('auth:sanctum');
    }

    public function index(Product $product)
    {
        $comments = $this->commentService->getCommentsByProductId($product->id);
        return CommentResource::collection($comments);
    }

    public function store(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $validator->validated();
        $data['product_id'] = $product->id;
        $data['user_id'] = Auth::id();

        $comment = $this->commentService->createComment($data);
        return new CommentResource($comment);
    }

    public function show(int $id)
    {
        $comment = $this->commentService->getCommentById($id);

        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        return new CommentResource($comment);
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $comment = $this->commentService->getCommentById($id);

        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        if (Auth::id() !== $comment->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $comment = $this->commentService->updateComment($id, $validator->validated());
        return new CommentResource($comment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $comment = $this->commentService->getCommentById($id);

        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        if (Auth::id() !== $comment->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $deleted = $this->commentService->deleteComment($id);

        if (!$deleted) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        return response()->json(null, 204);
    }
}
