<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    /**
     * Display a listing of all posts.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Data post berhasil diambil',
            'data'    => PostResource::collection(Post::all()),
        ], 200);
    }

    /**
     * Display the specified post with its comments.
     */
    public function show(int $id): JsonResponse
    {
        $post = Post::findOrFail($id);
        $post->load('comments');

        return response()->json([
            'success' => true,
            'message' => 'Data post ditemukan',
            'data'    => new PostResource($post),
        ], 200);
    }

    /**
     * Store a newly created post.
     */
    public function store(StorePostRequest $request): JsonResponse
    {
        $post = Post::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Post berhasil dibuat',
            'data'    => new PostResource($post),
        ], 201);
    }

    /**
     * Update the specified post.
     */
    public function update(UpdatePostRequest $request, int $id): JsonResponse
    {
        $post = Post::findOrFail($id);
        $post->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Post berhasil diperbarui',
            'data'    => new PostResource($post),
        ], 200);
    }

    /**
     * Remove the specified post (cascade deletes comments via FK).
     */
    public function destroy(int $id): JsonResponse
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post berhasil dihapus',
            'data'    => (object) [],
        ], 200);
    }
}
