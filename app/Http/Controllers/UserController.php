<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * Display a listing of all users.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Data user berhasil diambil',
            'data'    => UserResource::collection(User::all()),
        ], 200);
    }

    /**
     * Display the specified user.
     */
    public function show(int $id): JsonResponse
    {
        $user = User::findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Data user ditemukan',
            'data'    => new UserResource($user),
        ], 200);
    }

    /**
     * Store a newly created user.
     * Password is automatically hashed via the User model's 'hashed' cast.
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $user = User::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'User berhasil dibuat',
            'data'    => new UserResource($user),
        ], 201);
    }

    /**
     * Update the specified user.
     * Password hashing is handled by the model cast if password is provided.
     */
    public function update(UpdateUserRequest $request, int $id): JsonResponse
    {
        $user = User::findOrFail($id);
        $user->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'User berhasil diperbarui',
            'data'    => new UserResource($user),
        ], 200);
    }

    /**
     * Remove the specified user.
     */
    public function destroy(int $id): JsonResponse
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User berhasil dihapus',
            'data'    => (object) [],
        ], 200);
    }
}
