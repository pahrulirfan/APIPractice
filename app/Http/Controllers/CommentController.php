<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    /**
     * Display a listing of all comments.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Data comment berhasil diambil',
            'data'    => CommentResource::collection(Comment::all()),
        ], 200);
    }

    /**
     * Display the specified comment with its post.
     */
    public function show(int $id): JsonResponse
    {
        $comment = Comment::findOrFail($id);
        $comment->load('post');

        return response()->json([
            'success' => true,
            'message' => 'Data comment ditemukan',
            'data'    => new CommentResource($comment),
        ], 200);
    }

    /**
     * Display all comments belonging to a specific post.
     */
    public function byPost(int $id): JsonResponse
    {
        $post = Post::findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Data comment berhasil diambil',
            'data'    => CommentResource::collection($post->comments),
        ], 200);
    }

    /**
     * Store a newly created comment.
     */
    public function store(StoreCommentRequest $request): JsonResponse
    {
        $comment = Comment::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Comment berhasil dibuat',
            'data'    => new CommentResource($comment),
        ], 201);
    }

    /**
     * Update the specified comment.
     */
    public function update(UpdateCommentRequest $request, int $id): JsonResponse
    {
        $comment = Comment::findOrFail($id);
        $comment->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Comment berhasil diperbarui',
            'data'    => new CommentResource($comment),
        ], 200);
    }

    /**
     * Remove the specified comment.
     */
    public function destroy(int $id): JsonResponse
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Comment berhasil dihapus',
            'data'    => (object) [],
        ], 200);
    }
}
